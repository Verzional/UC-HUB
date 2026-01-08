<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Arta Boga Pelangi',
                'description' => 'Salah satu distributor produk konsumen (FMCG) terbesar di Indonesia yang merupakan bagian dari Orang Tua Group (OT).',
                'address' => 'Jl. Lingkar Luar Barat Kav. 35-36, Cengkareng, Jakarta Barat',
                'website' => 'https://artaboga.com',
                'industry' => 'Distribution & FMCG',
                'profile_photo_path' => null,
            ],
            [
                'name' => 'Avian Brands',
                'description' => 'Produsen cat terkemuka di Indonesia yang memproduksi berbagai jenis cat tembok, kayu, besi, dan dekoratif berkualitas tinggi.',
                'address' => 'Jl. Ahmad Yani No. 317, Surabaya, Jawa Timur',
                'website' => 'https://avianbrands.com',
                'industry' => 'Manufacturing & Chemicals',
                'profile_photo_path' => null,
            ],
            [
                'name' => 'Bank Permata (BPI)',
                'description' => 'Lembaga keuangan perbankan terkemuka di Indonesia yang menawarkan solusi perbankan ritel, korporat, dan syariah.',
                'address' => 'Gedung World Trade Center II, Jl. Jend. Sudirman Kav. 29-31, Jakarta',
                'website' => 'https://permatabank.com',
                'industry' => 'Banking & Finance',
                'profile_photo_path' => null,
            ],
            [
                'name' => 'Garuda Indonesia',
                'description' => 'Maskapai penerbangan nasional Indonesia yang melayani rute domestik dan internasional dengan standar layanan bintang lima.',
                'address' => 'Garuda City Center, Bandara Internasional Soekarno-Hatta, Tangerang',
                'website' => 'https://garuda-indonesia.com',
                'industry' => 'Airlines & Logistics',
                'profile_photo_path' => null,
            ],
            [
                'name' => 'HSBC Indonesia',
                'description' => 'Bagian dari grup perbankan internasional HSBC yang menyediakan layanan perbankan komersial, investasi, dan manajemen kekayaan.',
                'address' => 'World Trade Center I, Jl. Jend. Sudirman Kav. 29-31, Jakarta',
                'website' => 'https://hsbc.co.id',
                'industry' => 'Banking & Finance',
                'profile_photo_path' => null,
            ],
            [
                'name' => 'Papaya Fresh Gallery',
                'description' => 'Jaringan supermarket premium yang mengkhususkan diri pada produk segar dan barang impor khas Jepang berkualitas tinggi.',
                'address' => 'Jl. Raya Darmo Permai Selatan No. 3, Surabaya, Jawa Timur',
                'website' => 'https://papaya-group.com',
                'industry' => 'Retail & Supermarket',
                'profile_photo_path' => null,
            ],
            [
                'name' => 'Polygon Bikes',
                'description' => 'Merek sepeda global asal Indonesia (Insera Sena) yang memproduksi berbagai jenis sepeda mulai dari MTB hingga Road Bike.',
                'address' => 'Jl. Wadungasri No. 189, Waru, Sidoarjo, Jawa Timur',
                'website' => 'https://polygonbikes.com',
                'industry' => 'Manufacturing & Sports',
                'profile_photo_path' => null,
            ],
            [
                'name' => 'SANF (Surya Artha Nusantara Finance)',
                'description' => 'Perusahaan pembiayaan investasi dan modal kerja yang berfokus pada penyediaan alat berat dan infrastruktur, bagian dari Astra International.',
                'address' => 'Gedung Menara Astra, Jl. Jend. Sudirman Kav. 5-6, Jakarta',
                'website' => 'https://sanf.co.id',
                'industry' => 'Multifinance',
                'profile_photo_path' => null,
            ],
            [
                'name' => 'SPIL (Salam Pacific Indonesia Lines)',
                'description' => 'Perusahaan pelayaran logistik peti kemas terkemuka di Indonesia yang menghubungkan berbagai pulau melalui jalur laut.',
                'address' => 'Jl. Kalianak No. 51, Surabaya, Jawa Timur',
                'website' => 'https://spil.co.id',
                'industry' => 'Shipping & Logistics',
                'profile_photo_path' => null,
            ],
            [
                'name' => 'Viva Cosmetics',
                'description' => 'Produsen kosmetik legendaris Indonesia (PT Vitapharm) yang dikenal dengan produk perawatan wajah dan kecantikan yang sesuai untuk daerah tropis.',
                'address' => 'Jl. Panjang Jiwo No. 42, Surabaya, Jawa Timur',
                'website' => 'https://vivacosmetic.com',
                'industry' => 'Cosmetics & Beauty',
                'profile_photo_path' => null,
            ],
            ['name' => 'GoTo (Gojek Tokopedia)', 'description' => 'Ekosistem digital terbesar di Indonesia yang menyediakan layanan on-demand, e-commerce, dan keuangan.', 'address' => 'Pasaraya Blok M Gedung B, Jakarta Selatan', 'website' => 'https://gotocompany.com', 'industry' => 'Technology', 'profile_photo_path' => null],
            ['name' => 'Traveloka', 'description' => 'Platform travel terkemuka di Asia Tenggara yang menyediakan akses untuk berbagai kebutuhan perjalanan dan gaya hidup.', 'address' => 'Wisma 77 Tower 2, Slipi, Jakarta Barat', 'website' => 'https://traveloka.com', 'industry' => 'Technology & Travel', 'profile_photo_path' => null],
            ['name' => 'Bukalapak', 'description' => 'Perusahaan teknologi Indonesia yang berfokus pada pemberdayaan UMKM melalui platform e-commerce dan O2O.', 'address' => 'Metropolitan Tower, Cilandak, Jakarta Selatan', 'website' => 'https://bukalapak.com', 'industry' => 'E-commerce', 'profile_photo_path' => null],
            ['name' => 'Dana Indonesia', 'description' => 'Layanan keuangan digital dompet elektronik yang memodernisasi pembayaran tunai di Indonesia.', 'address' => 'Capital Place, Jakarta Selatan', 'website' => 'https://dana.id', 'industry' => 'Fintech', 'profile_photo_path' => null],
            ['name' => 'Bank Central Asia (BCA)', 'description' => 'Bank swasta terbesar di Indonesia yang dikenal dengan layanan perbankan transaksional yang andal.', 'address' => 'Menara BCA, Grand Indonesia, Jakarta Pusat', 'website' => 'https://bca.co.id', 'industry' => 'Banking', 'profile_photo_path' => null],
            ['name' => 'Bank Mandiri', 'description' => 'Salah satu bank BUMN terbesar yang menyediakan berbagai solusi keuangan terintegrasi.', 'address' => 'Jl. Jend. Gatot Subroto Kav. 36-38, Jakarta Selatan', 'website' => 'https://bankmandiri.co.id', 'industry' => 'Banking', 'profile_photo_path' => null],
            ['name' => 'Bank Rakyat Indonesia (BRI)', 'description' => 'Bank pemerintah yang fokus pada pemberdayaan sektor mikro, kecil, dan menengah (UMKM).', 'address' => 'Gedung BRI, Jl. Jend. Sudirman, Jakarta Pusat', 'website' => 'https://bri.co.id', 'industry' => 'Banking', 'profile_photo_path' => null],
            ['name' => 'Adira Finance', 'description' => 'Perusahaan pembiayaan terkemuka untuk kendaraan bermotor dan peralatan rumah tangga.', 'address' => 'The Landmark Tower, Jakarta Selatan', 'website' => 'https://adira.co.id', 'industry' => 'Multifinance', 'profile_photo_path' => null],
            ['name' => 'Unilever Indonesia', 'description' => 'Produsen produk kebutuhan rumah tangga, perawatan tubuh, dan makanan terkemuka.', 'address' => 'BSD Green Office Park, Tangerang', 'website' => 'https://unilever.co.id', 'industry' => 'FMCG', 'profile_photo_path' => null],
            ['name' => 'Indofood CBP', 'description' => 'Produsen mie instan (Indomie) dan berbagai produk makanan olahan terbesar di dunia.', 'address' => 'Sudirman Plaza, Indofood Tower, Jakarta Pusat', 'website' => 'https://indofoodcbp.com', 'industry' => 'FMCG', 'profile_photo_path' => null],
            ['name' => 'Mayora Indah', 'description' => 'Perusahaan global asal Indonesia yang memproduksi biskuit, kopi, dan permen (Kopiko, Danisa).', 'address' => 'Jl. Tomang Raya No. 21, Jakarta Barat', 'website' => 'https://mayoraindah.co.id', 'industry' => 'FMCG', 'profile_photo_path' => null],
            ['name' => 'Wings Group', 'description' => 'Produsen lokal raksasa untuk produk sabun, deterjen, dan makanan minuman (Mie Sedaap).', 'address' => 'Jl. Tipar Cakung Kav. F 5-7, Jakarta Timur', 'website' => 'https://wingscorp.com', 'industry' => 'FMCG', 'profile_photo_path' => null],
            ['name' => 'Kalbe Farma', 'description' => 'Perusahaan kesehatan dan farmasi terbesar di Asia Tenggara dengan fokus pada nutrisi dan obat-obatan.', 'address' => 'Jl. Letjen Suprapto Kav. 4, Jakarta Pusat', 'website' => 'https://kalbe.co.id', 'industry' => 'Pharmaceutical', 'profile_photo_path' => null],
            ['name' => 'Telkom Indonesia', 'description' => 'Perusahaan informasi dan komunikasi serta penyedia jasa dan jaringan telekomunikasi terbesar di Indonesia.', 'address' => 'The Telkom Hub, Jakarta Selatan', 'website' => 'https://telkom.co.id', 'industry' => 'Telecommunication', 'profile_photo_path' => null],
            ['name' => 'Telkomsel', 'description' => 'Operator telekomunikasi seluler terbesar yang merupakan anak perusahaan Telkom.', 'address' => 'Telkomsel Smart Office, Jakarta Selatan', 'website' => 'https://telkomsel.com', 'industry' => 'Telecommunication', 'profile_photo_path' => null],
            ['name' => 'Indosat Ooredoo Hutchison', 'description' => 'Penyedia layanan telekomunikasi digital terkemuka hasil merger Indosat dan Tri.', 'address' => 'Jl. Medan Merdeka Barat No. 21, Jakarta Pusat', 'website' => 'https://ioh.co.id', 'industry' => 'Telecommunication', 'profile_photo_path' => null],
            ['name' => 'Pertamina', 'description' => 'BUMN energi terintegrasi yang mencakup minyak, gas, dan energi terbarukan.', 'address' => 'Jl. Medan Merdeka Timur No. 1A, Jakarta Pusat', 'website' => 'https://pertamina.com', 'industry' => 'Energy', 'profile_photo_path' => null],
            ['name' => 'PLN (Persero)', 'description' => 'BUMN penyedia ketenagalistrikan yang melayani seluruh wilayah Indonesia.', 'address' => 'Jl. Trunojoyo Blok M - I/135, Jakarta Selatan', 'website' => 'https://pln.co.id', 'industry' => 'Utility & Energy', 'profile_photo_path' => null],
            ['name' => 'Adaro Energy', 'description' => 'Perusahaan energi terintegrasi dengan fokus utama pada pertambangan batu bara.', 'address' => 'Menara Karya, Kuningan, Jakarta Selatan', 'website' => 'https://adaro.com', 'industry' => 'Mining', 'profile_photo_path' => null],
            ['name' => 'Freeport Indonesia', 'description' => 'Perusahaan tambang emas dan tembaga terbesar yang beroperasi di Dataran Tinggi Tembagapura.', 'address' => 'Gedung Plaza 89, Jakarta Selatan', 'website' => 'https://ptfi.co.id', 'industry' => 'Mining', 'profile_photo_path' => null],
            ['name' => 'Sinar Mas Land', 'description' => 'Pengembang properti terbesar dan terdiversifikasi yang membangun kota mandiri (BSD City).', 'address' => 'BSD City, Tangerang', 'website' => 'https://sinarmasland.com', 'industry' => 'Property', 'profile_photo_path' => null],
            ['name' => 'Ciputra Group', 'description' => 'Salah satu grup pengembang real estate terkemuka dengan proyek di berbagai kota besar.', 'address' => 'DBS Bank Tower, Jakarta Selatan', 'website' => 'https://ciputra.com', 'industry' => 'Property', 'profile_photo_path' => null],
            ['name' => 'Alfamart (Sumber Alfaria Trijaya)', 'description' => 'Jaringan minimarket dengan cabang terbanyak yang menjangkau hampir seluruh pelosok Indonesia.', 'address' => 'Alfa Tower, Alam Sutera, Tangerang', 'website' => 'https://alfamart.co.id', 'industry' => 'Retail', 'profile_photo_path' => null],
            ['name' => 'Indomaret (Indomarco Prismatama)', 'description' => 'Pelopor jaringan minimarket waralaba terbesar di Indonesia.', 'address' => 'Jl. Terusan Mandala No. 2, Jakarta Barat', 'website' => 'https://indomaret.co.id', 'industry' => 'Retail', 'profile_photo_path' => null],
            ['name' => 'Erajaya Active Lifestyle', 'description' => 'Distributor dan peritel gadget, perangkat IoT, dan produk gaya hidup (iBox, Erafone).', 'address' => 'Erajaya Plaza, Jakarta Barat', 'website' => 'https://erajaya.com', 'industry' => 'Retail & Distribution', 'profile_photo_path' => null],
            ['name' => 'Matahari Department Store', 'description' => 'Peritel modern terbesar di Indonesia untuk produk pakaian, aksesori, dan kecantikan.', 'address' => 'Menara Matahari, Lippo Karawaci, Tangerang', 'website' => 'https://matahari.com', 'industry' => 'Retail', 'profile_photo_path' => null],
            ['name' => 'JNE Express', 'description' => 'Perusahaan ekspedisi pengiriman paket dan dokumen domestik paling populer.', 'address' => 'Jl. Tomang Raya No. 11, Jakarta Barat', 'website' => 'https://jne.co.id', 'industry' => 'Logistics', 'profile_photo_path' => null],
            ['name' => 'J&T Express', 'description' => 'Perusahaan logistik berbasis teknologi yang melayani pengiriman cepat se-Asia Tenggara.', 'address' => 'Landmark Pluit, Jakarta Utara', 'website' => 'https://jet.co.id', 'industry' => 'Logistics', 'profile_photo_path' => null], // FIXED TYPO HERE
            ['name' => 'Blue Bird Group', 'description' => 'Penyedia layanan transportasi taksi dan logistik darat terpercaya.', 'address' => 'Jl. Mampang Prapatan Raya No. 60, Jakarta Selatan', 'website' => 'https://bluebirdgroup.com', 'industry' => 'Transportation', 'profile_photo_path' => null],
            ['name' => 'KAI (Kereta Api Indonesia)', 'description' => 'Penyedia layanan transportasi kereta api penumpang dan barang di Pulau Jawa dan Sumatera.', 'address' => 'Jl. Perintis Kemerdekaan No. 1, Bandung', 'website' => 'https://kai.id', 'industry' => 'Transportation', 'profile_photo_path' => null],
            ['name' => 'Astra International', 'description' => 'Konglomerat multinasional Indonesia yang menguasai pasar otomotif, alat berat, dan jasa keuangan.', 'address' => 'Menara Astra, Jl. Jend. Sudirman, Jakarta Pusat', 'website' => 'https://astra.co.id', 'industry' => 'Automotive & Conglomerate', 'profile_photo_path' => null],
            ['name' => 'Toyota Astra Motor', 'description' => 'Agen Tunggal Pemegang Merek Toyota di Indonesia yang memimpin pangsa pasar otomotif.', 'address' => 'Jl. Laksda Yos Sudarso, Jakarta Utara', 'website' => 'https://toyota.astra.co.id', 'industry' => 'Automotive', 'profile_photo_path' => null],
            ['name' => 'Honda Prospect Motor', 'description' => 'Produsen dan distributor resmi mobil Honda di Indonesia.', 'address' => 'Jl. Gaya Motor I, Jakarta Utara', 'website' => 'https://honda-indonesia.com', 'industry' => 'Automotive', 'profile_photo_path' => null],
            ['name' => 'Semen Indonesia (SIG)', 'description' => 'Produsen semen terbesar di Asia Tenggara yang membangun infrastruktur nasional.', 'address' => 'South Quarter, Jakarta Selatan', 'website' => 'https://sig.id', 'industry' => 'Construction Materials', 'profile_photo_path' => null],
            ['name' => 'MNI (MNC Media)', 'description' => 'Grup media terintegrasi terbesar di Asia Tenggara yang mengelola TV nasional (RCTI, MNCTV, GTV).', 'address' => 'MNC Center, Kebon Sirih, Jakarta Pusat', 'website' => 'https://mnc.co.id', 'industry' => 'Media', 'profile_photo_path' => null],
            ['name' => 'Traveloka Eats', 'description' => 'Bagian dari Traveloka yang fokus pada direktori kuliner dan layanan pengantaran makanan.', 'address' => 'Jakarta Selatan', 'website' => 'https://traveloka.com/en-id/restaurants', 'industry' => 'Food & Tech', 'profile_photo_path' => null],
            ['name' => 'Santika Indonesia Hotels', 'description' => 'Jaringan hotel lokal terkemuka yang mengedepankan keramah-tamahan khas Indonesia.', 'address' => 'Jl. Melawai VII No. 6, Jakarta Selatan', 'website' => 'https://santika.com', 'industry' => 'Hospitality', 'profile_photo_path' => null],
            ['name' => 'Bio Farma', 'description' => 'BUMN farmasi produsen vaksin kelas dunia yang memasok kebutuhan global.', 'address' => 'Jl. Pasteur No. 28, Bandung', 'website' => 'https://biofarma.co.id', 'industry' => 'Healthcare', 'profile_photo_path' => null],
            ['name' => 'Djarum', 'description' => 'Konglomerat yang berawal dari kretek, kini merambah ke teknologi (Blibli), perbankan (BCA), dan elektronik (Polytron).', 'address' => 'Jl. Aipda KS Tubun No. 2C, Jakarta Barat', 'website' => 'https://djarum.com', 'industry' => 'Conglomerate', 'profile_photo_path' => null],
            ['name' => 'Sampoerna (HM Sampoerna)', 'description' => 'Salah satu perusahaan tembakau terbesar di Indonesia dengan sejarah panjang sejak 1913.', 'address' => 'Jl. Rungkut Industri Kav. 18, Surabaya', 'website' => 'https://sampoerna.com', 'industry' => 'Tobacco', 'profile_photo_path' => null],
        ];

        foreach ($companies as $company) {
            if (!Company::where('name', $company['name'])->exists()) {
                Company::create($company);
            } else {
                echo "Company '{$company['name']}' already exists. Skipping...\n";
            }
        }
    }
}
