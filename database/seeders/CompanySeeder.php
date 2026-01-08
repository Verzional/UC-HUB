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
