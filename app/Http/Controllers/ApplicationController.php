<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        // Eager Loading Relasi
        $query = Application::with(['job', 'company'])
                    ->where('user_id', Auth::id());

        // 1. Filter Status
        if ($request->has('status') && is_array($request->status)) {
            $query->whereIn('status', $request->status);
        }

        // 2. Search (Menggunakan parameter 'search' sesuai snippet view)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            $query->where(function($q) use ($search) {
                $q->whereHas('job', function($subQ) use ($search) {
                    $subQ->where('title', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('company', function($subQ) use ($search) {
                    $subQ->where('name', 'LIKE', "%{$search}%");
                });
            });
        }

        $applications = $query->latest()->paginate(5);

        // LOGIKA AJAX: Jika request datang dari JS, kirim partial view saja
        if ($request->ajax()) {
            return view('applications.partials.application-list', compact('applications'))->render();
        }

        // Jika akses biasa, kirim full page
        return view('applications.myapplication', compact('applications'));
    }
}