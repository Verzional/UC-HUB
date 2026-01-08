<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Skill;
use Carbon\Carbon;

class JobSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            // Arta Boga Pelangi
            [
                'title' => 'Management Trainee Sales',
                'description' => 'Program percepatan karir untuk posisi managerial di bidang distribusi dan penjualan.',
                'location' => 'Jakarta Barat',
                'company_id' => 1,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 7,000,000 - 10,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00', 'end_time' => '17:00:00',
            ],
            // Avian Brands
            [
                'title' => 'R&D Chemist',
                'description' => 'Melakukan riset dan pengembangan formula cat dekoratif terbaru.',
                'location' => 'Surabaya',
                'company_id' => 2,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 6,000,000 - 9,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00', 'end_time' => '16:00:00',
            ],
            // Bank Permata
            [
                'title' => 'Relationship Manager',
                'description' => 'Mengelola portofolio nasabah prioritas dan menawarkan solusi finansial.',
                'location' => 'Jakarta Pusat',
                'company_id' => 3,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 8,000,000 - 12,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:30:00', 'end_time' => '17:30:00',
            ],
            // Garuda Indonesia
            [
                'title' => 'Flight Attendant',
                'description' => 'Memberikan pelayanan terbaik dan menjamin keselamatan penumpang selama penerbangan.',
                'location' => 'Tangerang',
                'company_id' => 4,
                'employment_type' => 'Contract',
                'salary' => 'Competitive',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '00:00:00', 'end_time' => '23:59:59',
            ],
            // HSBC Indonesia
            [
                'title' => 'Internal Auditor',
                'description' => 'Melakukan audit internal untuk memastikan kepatuhan terhadap standar perbankan internasional.',
                'location' => 'Jakarta Selatan',
                'company_id' => 5,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 10,000,000 - 15,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00', 'end_time' => '18:00:00',
            ],
            // Papaya Fresh Gallery
            [
                'title' => 'Store Supervisor',
                'description' => 'Mengawasi operasional harian supermarket dan pelayanan pelanggan.',
                'location' => 'Surabaya',
                'company_id' => 6,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 5,000,000 - 7,500,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '10:00:00', 'end_time' => '22:00:00',
            ],
            // Polygon Bikes
            [
                'title' => 'Product Designer (Bike)',
                'description' => 'Merancang desain frame dan geometri sepeda untuk performa tinggi.',
                'location' => 'Sidoarjo',
                'company_id' => 7,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 7,000,000 - 11,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00', 'end_time' => '17:00:00',
            ],
            // SANF
            [
                'title' => 'Credit Analyst',
                'description' => 'Menganalisis kelayakan kredit nasabah korporasi untuk pembiayaan alat berat.',
                'location' => 'Jakarta Pusat',
                'company_id' => 8,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 8,000,000 - 13,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00', 'end_time' => '17:00:00',
            ],
            // SPIL
            [
                'title' => 'Logistics Data Coordinator',
                'description' => 'Mengkoordinasikan arus peti kemas dan memantau efisiensi rute pelayaran.',
                'location' => 'Surabaya',
                'company_id' => 9,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 6,500,000 - 10,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00', 'end_time' => '17:00:00',
            ],
            // Viva Cosmetics
            [
                'title' => 'Digital Marketing Specialist',
                'description' => 'Mengelola kampanye iklan media sosial dan strategi konten digital.',
                'location' => 'Surabaya',
                'company_id' => 10,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 5,500,000 - 8,500,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00', 'end_time' => '16:00:00',
            ],
        ];

        $skillIds = Skill::pluck('id')->toArray();

        foreach ($jobs as $jobData) {
            if (
                !Job::where('title', $jobData['title'])
                    ->where('company_id', $jobData['company_id'])
                    ->exists()
            ) {
                $job = Job::create($jobData);
                $randomSkills = collect($skillIds)
                    ->random(rand(2, 4))
                    ->toArray();
                $job->skills()->attach($randomSkills);
            } else {
                echo "Job '{$jobData['title']}' for Company ID '{$jobData['company_id']}' already exists. Skipping...\n";
            }
        }

        // Attach skills to existing jobs that don't have any
        $allJobs = Job::all();
        foreach ($allJobs as $job) {
            if ($job->skills->isEmpty()) {
                $randomSkills = collect($skillIds)
                    ->random(min(4, count($skillIds)))
                    ->toArray();
                $job->skills()->attach($randomSkills);
            }
        }
    }
}
