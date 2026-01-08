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
            // 1. Arta Boga Pelangi
            [
                'title' => 'Management Trainee Sales',
                'description' => "Program percepatan karir untuk posisi managerial di bidang distribusi. \n\nResponsibilities:\n- Mengelola tim sales lapangan.\n- Mencapai target distribusi dan market share.\n- Menganalisis potensi pasar.\n\nRequirements:\n- Lulusan S1 semua jurusan (IPK min 3.00).\n- Memiliki jiwa kepemimpinan tinggi.\n- Bersedia ditempatkan di seluruh wilayah operasional.",
                'location' => 'Jakarta Barat',
                'company_id' => 1,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 7,000,000 - 10,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 2. Avian Brands
            [
                'title' => 'R&D Chemist',
                'description' => "Melakukan riset dan pengembangan formula cat. \n\nResponsibilities:\n- Mengembangkan formula cat dekoratif baru.\n- Melakukan uji kualitas bahan baku.\n- Mengoptimalkan efisiensi biaya produksi.\n\nRequirements:\n- S1 Teknik Kimia atau Kimia Murni.\n- Memahami karakter polimer dan pigmen.\n- Pengalaman minimal 1 tahun di laboratorium.",
                'location' => 'Surabaya',
                'company_id' => 2,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 6,000,000 - 9,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
            ],
            // 3. Bank Permata
            [
                'title' => 'Relationship Manager',
                'description' => "Mengelola portofolio nasabah prioritas. \n\nResponsibilities:\n- Memberikan konsultasi produk investasi dan perbankan.\n- Menjaga hubungan baik dengan nasabah high-net-worth.\n- Mencapai target sales wealth management.\n\nRequirements:\n- S1 dari universitas terkemuka.\n- Pengetahuan kuat tentang produk perbankan.\n- Komunikasi persuasif dan penampilan menarik.",
                'location' => 'Jakarta Pusat',
                'company_id' => 3,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 8,000,000 - 12,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:30:00',
                'end_time' => '17:30:00',
            ],
            // 4. Garuda Indonesia
            [
                'title' => 'Flight Attendant',
                'description' => "Menjamin keselamatan dan kenyamanan penumpang. \n\nResponsibilities:\n- Melakukan prosedur keselamatan penerbangan.\n- Memberikan layanan makanan dan minuman.\n- Membantu penumpang selama perjalanan.\n\nRequirements:\n- Pendidikan minimal SMA/SMK.\n- Tinggi badan proporsional.\n- Mampu berkomunikasi dalam Bahasa Inggris dengan fasih.",
                'location' => 'Tangerang',
                'company_id' => 4,
                'employment_type' => 'Contract',
                'salary' => 'Competitive',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '00:00:00',
                'end_time' => '23:59:59',
            ],
            // 5. HSBC Indonesia
            [
                'title' => 'Internal Auditor',
                'description' => "Audit internal operasional perbankan. \n\nResponsibilities:\n- Menilai kepatuhan terhadap regulasi perbankan.\n- Mengidentifikasi risiko operasional.\n- Menyusun laporan temuan audit.\n\nRequirements:\n- S1 Akuntansi atau Keuangan.\n- Memiliki sertifikasi audit (CIA/CISA) diutamakan.\n- Detail-oriented dan memiliki integritas tinggi.",
                'location' => 'Jakarta Selatan',
                'company_id' => 5,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 10,000,000 - 15,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ],
            // 6. Papaya Fresh Gallery
            [
                'title' => 'Store Supervisor',
                'description' => "Mengawasi operasional supermarket. \n\nResponsibilities:\n- Mengatur jadwal shift karyawan.\n- Memastikan ketersediaan stok barang segar.\n- Menangani keluhan pelanggan.\n\nRequirements:\n- Pengalaman minimal 2 tahun di bidang retail.\n- Memiliki kemampuan leadership.\n- Bersedia bekerja di akhir pekan/hari libur.",
                'location' => 'Surabaya',
                'company_id' => 6,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 5,000,000 - 7,500,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '10:00:00',
                'end_time' => '22:00:00',
            ],
            // 7. Polygon Bikes
            [
                'title' => 'Product Designer (Bike)',
                'description' => "Merancang desain frame sepeda kelas dunia. \n\nResponsibilities:\n- Mendesain geometri frame menggunakan CAD/Solidworks.\n- Melakukan pengujian kekuatan material.\n- Inovasi desain mengikuti tren industri sepeda.\n\nRequirements:\n- S1 Desain Produk atau Teknik Mesin.\n- Mahir software pemodelan 3D.\n- Memiliki passion yang besar di dunia bersepeda.",
                'location' => 'Sidoarjo',
                'company_id' => 7,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 7,000,000 - 11,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 8. SANF
            [
                'title' => 'Credit Analyst',
                'description' => "Analisis pembiayaan alat berat korporasi. \n\nResponsibilities:\n- Menganalisis laporan keuangan calon debitur.\n- Melakukan survey lapangan ke lokasi proyek.\n- Menyusun rekomendasi limit kredit.\n\nRequirements:\n- S1 Akuntansi/Manajemen Keuangan.\n- Mampu membaca laporan keuangan dengan mendalam.\n- Berpengalaman di perusahaan leasing lebih disukai.",
                'location' => 'Jakarta Pusat',
                'company_id' => 8,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 8,000,000 - 13,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 9. SPIL
            [
                'title' => 'Logistics Data Coordinator',
                'description' => "Koordinasi arus logistik kontainer. \n\nResponsibilities:\n- Memantau pergerakan kapal dan depo.\n- Mengoptimalkan utilisasi kontainer kosong.\n- Menyusun laporan efisiensi rute.\n\nRequirements:\n- S1 Teknik Industri atau Manajemen Logistik.\n- Mahir menggunakan Excel dan pengolahan data.\n- Tegas dan mampu bekerja di bawah tekanan.",
                'location' => 'Surabaya',
                'company_id' => 9,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 6,500,000 - 10,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 10. Viva Cosmetics
            [
                'title' => 'Digital Marketing Specialist',
                'description' => "Mengelola kehadiran digital brand Viva. \n\nResponsibilities:\n- Merencanakan konten harian media sosial.\n- Mengelola budget iklan Facebook & Instagram.\n- Berkolaborasi dengan Key Opinion Leaders (KOL).\n\nRequirements:\n- Memiliki portfolio pengelolaan akun media sosial.\n- Up-to-date dengan tren skincare/makeup.\n- Kreatif dan mahir copywriting.",
                'location' => 'Surabaya',
                'company_id' => 10,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 5,500,000 - 8,500,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
            ],
            // 11. Traveloka
            [
                'title' => 'Software Engineer (Backend)',
                'description' => "Membangun sistem microservices skala besar. \n\nResponsibilities:\n- Menulis kode yang scalable dan maintainable.\n- Mengoptimalkan performa database.\n- Integrasi API pihak ketiga.\n\nRequirements:\n- S1 Ilmu Komputer.\n- Menguasai Java, Go, atau Node.js.\n- Memahami konsep CI/CD dan Cloud (AWS/GCP).",
                'location' => 'Jakarta Selatan',
                'company_id' => 11,
                'employment_type' => 'Full-time',
                'salary' => 'Competitive',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ],
            // 12. Tokopedia
            [
                'title' => 'Product Manager',
                'description' => "Pengembangan fitur digital inovatif. \n\nResponsibilities:\n- Menyusun roadmap produk berdasarkan data user.\n- Berkoordinasi dengan tim Engineering dan Design.\n- Melakukan user testing dan feedback analysis.\n\nRequirements:\n- Pengalaman min 2 tahun sebagai PM.\n- Kemampuan problem solving yang kuat.\n- Berorientasi pada data (data-driven).",
                'location' => 'Jakarta Barat',
                'company_id' => 12,
                'employment_type' => 'Full-time',
                'salary' => 'Competitive',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ],
            // 13. BCA
            [
                'title' => 'Account Officer',
                'description' => "Analisis kredit dan relasi nasabah bisnis. \n\nResponsibilities:\n- Mencari nasabah potensial untuk pinjaman bisnis.\n- Menilai profil risiko calon debitur.\n- Memonitor kelancaran pembayaran.\n\nRequirements:\n- Lulusan S1 dengan IPK min 3.00.\n- Kemampuan analisis numerik yang tajam.\n- Memiliki integritas dan jujur.",
                'location' => 'Jakarta Pusat',
                'company_id' => 13,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 8,000,000 - 12,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 14. Unilever
            [
                'title' => 'Brand Manager',
                'description' => "Strategi pemasaran brand FMCG. \n\nResponsibilities:\n- Menyusun kampanye marketing tahunan.\n- Mengelola budget promosi.\n- Menganalisis kompetitor dan perilaku konsumen.\n\nRequirements:\n- Pengalaman min 3-5 tahun di bidang FMCG.\n- Visioner dan kreatif.\n- Lulusan S1 dari Manajemen/Marketing.",
                'location' => 'Tangerang',
                'company_id' => 14,
                'employment_type' => 'Full-time',
                'salary' => 'Competitive',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ],
            // 15. Indofood
            [
                'title' => 'Area Sales Manager',
                'description' => "Pengelolaan distribusi regional. \n\nResponsibilities:\n- Memastikan target penjualan di area tercapai.\n- Membina hubungan dengan distributor lokal.\n- Mengawasi performa tim sales area.\n\nRequirements:\n- Pengalaman manajerial di bidang sales min 3 tahun.\n- Bersedia melakukan perjalanan dinas luar kota.\n- Memiliki SIM A.",
                'location' => 'Jakarta Pusat',
                'company_id' => 15,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 10,000,000 - 14,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 16. Telkomsel
            [
                'title' => 'Network Engineer',
                'description' => "Pemeliharaan infrastruktur jaringan 4G/5G. \n\nResponsibilities:\n- Monitoring stabilitas jaringan.\n- Troubleshooting gangguan teknis BTS.\n- Optimasi kapasitas traffic data.\n\nRequirements:\n- S1 Teknik Telekomunikasi/Elektro.\n- Sertifikasi CCNA/CCNP diutamakan.\n- Bersedia standby untuk penanganan darurat.",
                'location' => 'Jakarta Selatan',
                'company_id' => 16,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 9,000,000 - 13,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ],
            // 17. Pertamina
            [
                'title' => 'Drilling Engineer',
                'description' => "Operasi pengeboran minyak dan gas. \n\nResponsibilities:\n- Menyusun rencana pengeboran (drilling plan).\n- Memastikan standar HSSE di lapangan.\n- Evaluasi teknis alat bor.\n\nRequirements:\n- S1 Teknik Perminyakan.\n- Memahami simulasi reservoir.\n- Siap ditempatkan di site offshore/onshore.",
                'location' => 'Jakarta Pusat',
                'company_id' => 17,
                'employment_type' => 'Full-time',
                'salary' => 'Competitive',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 18. Freeport Indonesia
            [
                'title' => 'Geologist',
                'description' => "Eksplorasi dan analisis mineral tambang. \n\nResponsibilities:\n- Melakukan pemetaan geologi lapangan.\n- Analisis sampel batuan di lab.\n- Menghitung estimasi cadangan mineral.\n\nRequirements:\n- S1 Teknik Geologi.\n- Fisik kuat untuk bekerja di area pegunungan.\n- Kemampuan analisis spasial yang baik.",
                'location' => 'Papua / Jakarta',
                'company_id' => 18,
                'employment_type' => 'Full-time',
                'salary' => 'High',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 19. Wijaya Karya
            [
                'title' => 'Civil Engineer',
                'description' => "Pengawasan proyek konstruksi infrastruktur. \n\nResponsibilities:\n- Mengawasi progres harian proyek.\n- Menghitung Rencana Anggaran Biaya (RAB).\n- Memastikan kualitas beton dan struktur.\n\nRequirements:\n- S1 Teknik Sipil.\n- Mahir AutoCAD dan SAP2000.\n- Tegas dalam memimpin sub-kontraktor.",
                'location' => 'Jakarta Selatan',
                'company_id' => 19,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 8,000,000 - 12,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 20. Alfamart
            [
                'title' => 'District Manager',
                'description' => "Pengawasan operasional toko retail area. \n\nResponsibilities:\n- Memastikan standar pelayanan toko (SOP) dijalankan.\n- Meminimalkan angka kehilangan barang (shrinkage).\n- Mengelola pengembangan karir kru toko.\n\nRequirements:\n- Pengalaman min 3 tahun di level supervisor retail.\n- Mobilitas tinggi ke berbagai lokasi toko.\n- Fokus pada target profitabilitas.",
                'location' => 'Jakarta Barat',
                'company_id' => 20,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 7,000,000 - 10,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 21. Gojek
            [
                'title' => 'App Developer',
                'description' => "Pengembangan sistem GoPay berbasis mobile. \n\nResponsibilities:\n- Implementasi UI/UX yang responsif.\n- Integrasi sistem pembayaran aman.\n- Optimasi penggunaan baterai dan memori aplikasi.\n\nRequirements:\n- S1 Informatika.\n- Mahir Kotlin (Android) atau Swift (iOS).\n- Memahami arsitektur Clean Code/MVVM.",
                'location' => 'Jakarta Selatan',
                'company_id' => 21,
                'employment_type' => 'Full-time',
                'salary' => 'Competitive',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ],
            // 22. Astra International
            [
                'title' => 'Mechanical Engineer',
                'description' => "Pengembangan sistem manufaktur otomotif. \n\nResponsibilities:\n- Maintenance mesin produksi otomatis.\n- Implementasi sistem Lean Manufacturing.\n- Analisis kegagalan teknis komponen.\n\nRequirements:\n- S1 Teknik Mesin.\n- Memahami sistem hidrolik dan pneumatik.\n- IPK minimal 3.25.",
                'location' => 'Jakarta Pusat',
                'company_id' => 22,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 9,000,000 - 14,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 23. XL Axiata
            [
                'title' => 'Customer Care Specialist',
                'description' => "Layanan solusi telekomunikasi korporasi. \n\nResponsibilities:\n- Menangani keluhan teknis akun B2B.\n- Memberikan edukasi layanan cloud/IoT.\n- Menjaga Service Level Agreement (SLA).\n\nRequirements:\n- S1 semua jurusan (Komunikasi diutamakan).\n- Berbahasa Inggris aktif.\n- Orientasi pada solusi dan sabar.",
                'location' => 'Jakarta Selatan',
                'company_id' => 23,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 5,000,000 - 7,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 24. J&T Express
            [
                'title' => 'Operation Supervisor',
                'description' => "Monitoring efisiensi logistik lapangan. \n\nResponsibilities:\n- Memastikan pengiriman paket tepat waktu.\n- Mengelola armada dan driver kurir.\n- Menangani masalah pengiriman di gudang transit.\n\nRequirements:\n- Pendidikan minimal S1.\n- Tegas dan mampu mengelola banyak orang.\n- Bersedia bekerja dalam pola shift.",
                'location' => 'Jakarta Barat',
                'company_id' => 24,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 6,000,000 - 8,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 25. Shopee
            [
                'title' => 'IT Support Specialist',
                'description' => "Maintenance infrastruktur IT kantor. \n\nResponsibilities:\n- Setup hardware dan software untuk karyawan baru.\n- Maintenance jaringan LAN/WIFI kantor.\n- Troubleshooting inventaris perangkat IT.\n\nRequirements:\n- D3/S1 Teknik Informatika/Sistem Informasi.\n- Paham instalasi OS Windows & macOS.\n- Respon cepat dalam menangani keluhan.",
                'location' => 'Jakarta Utara',
                'company_id' => 25,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 5,000,000 - 7,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 26. Bukalapak
            [
                'title' => 'Public Relation Officer',
                'description' => "Manajemen reputasi korporat. \n\nResponsibilities:\n- Menulis press release kegiatan perusahaan.\n- Menjalin hubungan dengan jurnalis/media.\n- Mengelola isu krisis di ruang publik.\n\nRequirements:\n- S1 Ilmu Komunikasi/PR.\n- Kemampuan menulis yang sangat baik.\n- Networking luas di kalangan media.",
                'location' => 'Jakarta Selatan',
                'company_id' => 26,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 7,000,000 - 9,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ],
            // 27. KAI
            [
                'title' => 'Station Master',
                'description' => "Kepala stasiun operasional perjalanan kereta. \n\nResponsibilities:\n- Mengatur kelancaran arus penumpang.\n- Koordinasi dengan pengatur perjalanan kereta api.\n- Memastikan kebersihan dan keamanan stasiun.\n\nRequirements:\n- Pendidikan minimal S1.\n- Tegas, berwibawa, dan bertanggung jawab.\n- Bersedia ditempatkan di mana saja.",
                'location' => 'Bandung',
                'company_id' => 27,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 6,000,000 - 9,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '07:00:00',
                'end_time' => '16:00:00',
            ],
            // 28. Mayora
            [
                'title' => 'Procurement Staff',
                'description' => "Pengadaan bahan baku produksi makanan. \n\nResponsibilities:\n- Mencari supplier dengan harga kompetitif.\n- Melakukan negosiasi kontrak vendor.\n- Memastikan stok bahan baku selalu aman.\n\nRequirements:\n- S1 Ekonomi/Teknik Industri.\n- Kemampuan negosiasi yang tangguh.\n- Detail terhadap administrasi dokumen.",
                'location' => 'Jakarta Barat',
                'company_id' => 28,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 6,000,000 - 8,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 29. Wings Group
            [
                'title' => 'Production Supervisor',
                'description' => "Mengontrol lini produksi consumer goods. \n\nResponsibilities:\n- Mencapai target output produksi harian.\n- Menjaga standar kebersihan dan keamanan kerja.\n- Mengelola operator mesin produksi.\n\nRequirements:\n- S1 Teknik Mesin/Industri/Kimia.\n- Memahami ISO 9001 & HACCP.\n- Siap bekerja dalam sistem shift.",
                'location' => 'Jakarta Timur',
                'company_id' => 29,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 7,000,000 - 10,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '07:00:00',
                'end_time' => '16:00:00',
            ],
            // 30. Kalbe Farma
            [
                'title' => 'Medical Representative',
                'description' => "Pemasaran produk farmasi ke tenaga medis. \n\nResponsibilities:\n- Edukasi produk kepada Dokter dan Apoteker.\n- Membangun kerjasama strategis dengan rumah sakit.\n- Mencapai target sales produk ethical.\n\nRequirements:\n- Pendidikan minimal D3/S1 (Farmasi/Biologi/Kesehatan).\n- Memiliki motor dan SIM C.\n- Komunikasi persuasif yang baik.",
                'location' => 'Jakarta Pusat',
                'company_id' => 30,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 6,000,000 - 9,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 31. PLN
            [
                'title' => 'Electrical Engineer',
                'description' => "Maintenance transmisi dan distribusi listrik. \n\nResponsibilities:\n- Pemeliharaan rutin gardu induk.\n- Penanganan gangguan listrik tegangan tinggi.\n- Studi teknis efisiensi daya.\n\nRequirements:\n- S1 Teknik Elektro (Arus Kuat).\n- Tidak buta warna.\n- Disiplin tinggi terhadap SOP K3.",
                'location' => 'Jakarta Selatan',
                'company_id' => 31,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 8,000,000 - 11,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '08:00:00',
                'end_time' => '17:00:00',
            ],
            // 32. Adaro Energy
            [
                'title' => 'Mining Supervisor',
                'description' => "Pengawasan operasional pit tambang. \n\nResponsibilities:\n- Mengatur pergerakan alat berat di lapangan.\n- Memastikan target produksi batubara tercapai.\n- Monitoring aspek keamanan tambang.\n\nRequirements:\n- S1 Teknik Pertambangan.\n- Memiliki sertifikat POP (Pengawas Operasional Pertama).\n- Bersedia bekerja di remote area.",
                'location' => 'Jakarta Selatan',
                'company_id' => 32,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 10,000,000 - 15,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '07:00:00',
                'end_time' => '16:00:00',
            ],
            // 33. Sinarmas Land
            [
                'title' => 'Urban Planner',
                'description' => "Perencanaan kawasan kota mandiri BSD City. \n\nResponsibilities:\n- Menyusun master plan kawasan residensial/komersial.\n- Analisis dampak lingkungan dan lalu lintas.\n- Koordinasi dengan arsitek dan pemerintah.\n\nRequirements:\n- S1 Perencanaan Wilayah dan Kota (PWK).\n- Mahir software GIS dan AutoCAD.\n- Memiliki visi desain kota modern berkelanjutan.",
                'location' => 'Tangerang',
                'company_id' => 33,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 9,000,000 - 13,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ],
            // 34. Honda Indonesia
            [
                'title' => 'Production Staff',
                'description' => "Perakitan presisi kendaraan bermotor. \n\nResponsibilities:\n- Melakukan assembly komponen mesin.\n- Quality control pada setiap tahap perakitan.\n- Menjaga kebersihan area kerja (5S).\n\nRequirements:\n- Minimal SMK Teknik Otomotif/Mesin.\n- Fisik sehat dan tidak memiliki gangguan mata.\n- Mampu bekerja dengan target waktu ketat.",
                'location' => 'Jakarta Utara',
                'company_id' => 34,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 5,000,000 - 7,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '07:00:00',
                'end_time' => '16:00:00',
            ],
            // 35. Bank Mandiri
            [
                'title' => 'Treasury Officer',
                'description' => "Manajemen likuiditas perbankan. \n\nResponsibilities:\n- Transaksi valuta asing dan surat berharga.\n- Monitoring posisi devisa bank.\n- Analisis pergerakan suku bunga global.\n\nRequirements:\n- S1 Ekonomi/Matematika/Statistik.\n- Memiliki minat tinggi pada pasar modal.\n- Kemampuan analisis data yang kuat.",
                'location' => 'Jakarta Selatan',
                'company_id' => 35,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 8,000,000 - 12,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
            ],
            // 36. Astra International (Group)
            [
                'title' => 'Corporate Analyst',
                'description' => "Analisis strategis bisnis grup Astra. \n\nResponsibilities:\n- Evaluasi performa unit bisnis di bawah grup.\n- Analisis kelayakan investasi/akuisisi baru.\n- Menyusun laporan strategis untuk Direksi.\n\nRequirements:\n- S1/S2 Keuangan atau Bisnis dari universitas ternama.\n- Pengalaman min 2 tahun di consulting atau equity research.\n- Skill presentasi yang sangat baik.",
                'location' => 'Jakarta Barat',
                'company_id' => 36,
                'employment_type' => 'Full-time',
                'salary' => 'IDR 12,000,000 - 18,000,000',
                'application_deadline' => Carbon::now()->addDays(30)->toDateString(),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
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
