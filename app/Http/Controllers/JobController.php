<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $maxSalaryRaw = Job::selectRaw("
            MAX(CAST(REPLACE(REPLACE(SUBSTRING_INDEX(salary_range, '-', 1), 'Rp ', ''), '.', '') AS UNSIGNED)) as max_salary
        ")->value('max_salary');

        $globalMaxSalary = $maxSalaryRaw ? ceil($maxSalaryRaw / 1000000) * 1000000 : 20000000;

        $query = Job::with('company'); 

        // Filter Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhereHas('company', function($subQ) use ($search) {
                      $subQ->where('name', 'like', "%$search%");
                  });
            });
        }

        // Filter Location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter Category
        if ($request->filled('categories')) {
            $query->where(function($q) use ($request) {
                foreach ($request->categories as $cat) {
                    $q->orWhereJsonContains('category_ids', $cat);
                }
            });
        }

        // Filter Job Type
        if ($request->filled('types')) {
            $query->where(function($q) use ($request) {
                foreach ($request->types as $type) {
                    $q->orWhere('type', 'like', "%$type%");
                }
            });
        }

        // Filter Work Model
        if ($request->filled('work_model')) {
            $model = $request->work_model;
            $query->where(function($q) use ($model) {
                $q->where('type', 'like', "%$model%")
                  ->orWhere('location', 'like', "%$model%");
            });
        }

        // Filter Salary
        if ($request->filled('min_salary')) {
            $query->whereRaw("CAST(REPLACE(REPLACE(SUBSTRING_INDEX(salary_range, '-', 1), 'Rp ', ''), '.', '') AS UNSIGNED) >= ?", [$request->min_salary]);
        }
        if ($request->filled('max_salary')) {
            $query->whereRaw("CAST(REPLACE(REPLACE(SUBSTRING_INDEX(salary_range, '-', 1), 'Rp ', ''), '.', '') AS UNSIGNED) <= ?", [$request->max_salary]);
        }

        $jobs = $query->latest()->paginate(5);
        $categories = Category::all();

        if ($request->ajax()) {
            return view('jobs.partials.job-list', compact('jobs'))->render();
        }

        return view('jobs.listjob', compact('jobs', 'categories', 'globalMaxSalary'));
    }

    public function show($id)
{
    // 1. Load Job dengan Company DAN Skills
    $job = Job::with(['company', 'skills'])->findOrFail($id);

    // 2. Cek Favorite
    $isFavorited = false;
    if (Auth::check()) {
        $isFavorited = Auth::user()->favorites()->where('job_id', $job->id)->exists();
    }

    // 3. LOGIKA MATCHING SCORE (Hanya jika user login)
    $matchPercent = 0;
    $matchingSkills = collect([]);
    $missingSkills = collect([]);
    $hasSkillsData = false;

    if (Auth::check()) {
        $user = Auth::user()->load('userSkills'); // Gunakan relasi userSkills yg kita buat sebelumnya
        
        $jobSkills = $job->skills; // Collection skill yang dibutuhkan job
        $userSkillIds = $user->userSkills->pluck('id')->toArray(); // Array ID skill user

        if ($jobSkills->count() > 0) {
            $hasSkillsData = true;
            
            // Filter skill yang cocok
            $matchingSkills = $jobSkills->filter(function ($skill) use ($userSkillIds) {
                return in_array($skill->id, $userSkillIds);
            });

            // Filter skill yang tidak dimiliki user
            $missingSkills = $jobSkills->filter(function ($skill) use ($userSkillIds) {
                return !in_array($skill->id, $userSkillIds);
            });

            // Hitung Persentase
            $matchPercent = round(($matchingSkills->count() / $jobSkills->count()) * 100);
        }
    }

    // 4. Similar Jobs
    $similarJobs = Job::with('company')
        ->where('id', '!=', $job->id)
        ->where(function($q) use ($job) {
            if (!empty($job->category_ids)) {
                foreach ($job->category_ids as $cat) {
                    $q->orWhereJsonContains('category_ids', $cat);
                }
            }
        })
        ->inRandomOrder()
        ->take(5)
        ->get();

    return view('jobs.detailjob', compact(
        'job', 
        'similarJobs', 
        'isFavorited',
        'matchPercent',
        'matchingSkills',
        'missingSkills',
        'hasSkillsData'
    ));
}

    public function toggleFavorite($id)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $job = Job::findOrFail($id);
        $result = $user->favorites()->toggle($job->id);
        $isFavorited = count($result['attached']) > 0;

        return response()->json([
            'status' => 'success',
            'is_favorited' => $isFavorited
        ]);
    }

    public function savedJobs(Request $request)
{
    // 1. Inisialisasi query (Default kosong jika guest)
    $savedJobs = collect([]);

    if (Auth::check()) {
        // Ambil relasi favorites user (pastikan nama relasi di model User adalah 'favorites' atau 'savedJobs')
        // Gunakan with('company') untuk mencegah N+1 Query problem
        $query = Auth::user()->favorites()->with('company');

        // 2. Logic Search (Filter Title atau Company Name)
        if ($request->has('q') && $request->q != '') {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhereHas('company', function($subQ) use ($search) {
                      $subQ->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        // 3. Logic Sorting (Newest vs Oldest saved)
        // orderByPivot digunakan karena kita mengurutkan berdasarkan kapan user menyimpan (tabel pivot)
        if ($request->has('sort') && $request->sort == 'oldest') {
            $query->orderByPivot('created_at', 'asc');
        } else {
            $query->orderByPivot('created_at', 'desc'); // Default: Paling baru disimpan
        }

        $savedJobs = $query->get();
    }

    // 4. Handle AJAX Request (Search tanpa reload)
    if ($request->ajax()) {
        // Return hanya bagian list card-nya saja
        return view('jobs.partials.saved-jobs-list', compact('savedJobs'))->render();
    }

    // 5. Handle Normal Request (Full Page Load)
    return view('jobs.saved_jobs', compact('savedJobs'));
}

    public function removeFavorite(Job $job)
    {
        if (Auth::check()) {
            Auth::user()->favorites()->detach($job->id);
        }

        return back()->with('success', 'Job removed from favorites.');
    }

    // --- PERBAIKAN UTAMA DI SINI ---
    public function apply(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        // 1. Cek Duplikasi
        $exists = Application::where('user_id', $user->id)->where('job_id', $job->id)->exists();
        if ($exists) {
            return response()->json(['message' => 'You have already applied for this job.'], 422);
        }

        // 2. Validasi
        $request->validate([
            'phone' => 'required|string',
            'major' => 'required|string',
            'cv_source' => 'required|in:saved,upload',
            'cv_file' => 'required_if:cv_source,upload|nullable|mimes:pdf|max:5120',
            'portfolio_source' => 'required|in:saved,upload',
            'portfolio_file' => 'required_if:portfolio_source,upload|nullable|mimes:pdf|max:5120',
            'cover_letter' => 'nullable|mimes:pdf|max:5120',
        ]);

        // 3. Handle Files
        $cvFilename = null;
        if ($request->cv_source === 'saved') {
            if (!$user->saved_cv_name) return response()->json(['message' => 'No saved CV found.'], 422);
            $cvFilename = $user->saved_cv_name;
        } else {
            $file = $request->file('cv_file');
            $cvFilename = $file->getClientOriginalName(); 
            $file->storeAs('documents', $cvFilename, 'public');
        }

        $portoFilename = null;
        if ($request->portfolio_source === 'saved') {
            if (!$user->saved_portfolio_name) return response()->json(['message' => 'No saved Portfolio found.'], 422);
            $portoFilename = $user->saved_portfolio_name;
        } else {
            if ($request->hasFile('portfolio_file')) {
                $file = $request->file('portfolio_file');
                $portoFilename = $file->getClientOriginalName();
                $file->storeAs('documents', $portoFilename, 'public');
            } else {
                return response()->json(['message' => 'Portfolio is required.'], 422);
            }
        }

        $clFilename = null;
        if ($request->hasFile('cover_letter')) {
            $file = $request->file('cover_letter');
            $clFilename = $file->getClientOriginalName();
            $file->storeAs('documents', $clFilename, 'public');
        }

        // 4. Timeline
        $defaultTimeline = [
            ['title' => 'Application Sent', 'date' => now()->format('d M Y'), 'isCompleted' => true, 'isActive' => true],
            ['title' => 'Under Review', 'date' => 'Pending', 'isCompleted' => false, 'isActive' => false]
        ];

        // 5. Simpan ke Database (VERSI BERSIH: Hapus job_title, company_name, dll)
        Application::create([
            'user_id' => $user->id,
            'job_id' => $job->id,
            'company_id' => $job->company_id, // Ambil dari Job
            
            'status' => 'Ditinjau',
            'applied_date' => now(),
            
            'cv_file_name' => $cvFilename,
            'portfolio_file_name' => $portoFilename,
            'cover_letter_file_name' => $clFilename,
            'timeline' => $defaultTimeline,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Application submitted successfully!']);
    }
}