<?php

namespace Database\Seeders;

use App\Models\EnsiklopediPenyakit;
use App\Models\HargaKomoditas;
use App\Models\KategoriProduk;
use App\Models\Komoditas;
use App\Models\PanduanDosisPupuk;
use App\Models\Pengguna;
use App\Models\PengumumanBeranda;
use App\Models\Produk;
use App\Models\ProfilAhli;
use Illuminate\Database\Seeder;

class SolutanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Uji: Admin & Petani
        Pengguna::create([
            'nama' => 'Admin Solutan',
            'no_hp' => '081100000001',
            'kata_sandi' => 'solutan123',
            'peran' => 'admin',
            'kabupaten' => 'Semarang',
        ]);

        Pengguna::create([
            'nama' => 'Slamet Raharjo',
            'no_hp' => '081234567890',
            'kata_sandi' => 'petani123',
            'peran' => 'petani',
            'desa' => 'Sukamaju',
            'kecamatan' => 'Polanharjo',
            'kabupaten' => 'Klaten',
            'alamat_pengiriman' => 'Dusun Krajan RT 02/RW 01, Desa Sukamaju, Kec. Polanharjo, Klaten',
        ]);

        // 2. Mantri Tani / Ahli Pertanian Aktif
        $daftarAhli = [
            [
                'nama' => 'Mantri Tani Spesialis Padi',
                'no_hp' => '081100000101',
                'spesialisasi' => 'Pengendalian Hama & Penyakit Padi',
                'bidang_fokus' => 'Wereng Batang, Bercak Daun, Busuk Pelepah',
                'deskripsi' => 'Membantu diagnosa foto daun padi, jadwal pengairan, hingga dosis fungisida dan insektisida terdaftar.',
            ],
            [
                'nama' => 'Ahli Hortikultura Cabai & Bawang',
                'no_hp' => '081100000102',
                'spesialisasi' => 'Perlindungan Tanaman Sayuran',
                'bidang_fokus' => 'Virus Kuning, Kutu Kebul, Layu Fusarium',
                'deskripsi' => 'Pendampingan perawatan bedengan cabai rawit dan bawang merah agar tahan cuaca dan panen optimal.',
            ],
            [
                'nama' => 'Dokter Tanaman & Kesuburan Tanah',
                'no_hp' => '081100000103',
                'spesialisasi' => 'Nutrisi Lahan & Dosis Pupuk',
                'bidang_fokus' => 'Takaran Urea/NPK, Pupuk Organik, Jagung & Palawija',
                'deskripsi' => 'Menyesuaikan takaran pupuk dasar dan susulan berdasarkan kondisi tanah serta fase tumbuh tanaman Anda.',
            ],
        ];

        foreach ($daftarAhli as $ahli) {
            $userAhli = Pengguna::create([
                'nama' => $ahli['nama'],
                'no_hp' => $ahli['no_hp'],
                'kata_sandi' => 'ahli1234',
                'peran' => 'ahli',
            ]);

            ProfilAhli::create([
                'pengguna_id' => $userAhli->id,
                'spesialisasi' => $ahli['spesialisasi'],
                'bidang_fokus' => $ahli['bidang_fokus'],
                'deskripsi' => $ahli['deskripsi'],
                'sedang_online' => true,
                'rata_rata_balas_menit' => 5,
            ]);
        }

        // 3. Kategori & Produk Toko Pertanian
        $katBenih = KategoriProduk::create(['nama' => 'Benih unggul', 'slug' => 'benih']);
        $katPupuk = KategoriProduk::create(['nama' => 'Pupuk organik & subsidi', 'slug' => 'pupuk']);
        $katProteksi = KategoriProduk::create(['nama' => 'Pestisida & alsintan', 'slug' => 'proteksi']);

        Produk::insert([
            [
                'kategori_id' => $katBenih->id,
                'nama' => 'Benih Padi Unggul Bersertifikat (5 kg)',
                'slug' => 'benih-padi-unggul-bersertifikat',
                'deskripsi' => 'Benih tahan hama dengan garansi keaslian 100%, siap kirim langsung ke desa.',
                'harga' => 85000,
                'persen_diskon' => 20,
                'stok' => 120,
                'produk_subsidi' => false,
                'bisa_cod' => true,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => $katPupuk->id,
                'nama' => 'Pupuk Organik Penyubur Lahan (40 kg)',
                'slug' => 'pupuk-organik-penyubur-lahan',
                'deskripsi' => 'Memperbaiki struktur tanah sawah dan ladang untuk musim tanam lebih subur.',
                'harga' => 65000,
                'persen_diskon' => 35,
                'stok' => 200,
                'produk_subsidi' => false,
                'bisa_cod' => true,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => $katPupuk->id,
                'nama' => 'Pupuk NPK Majemuk Non-Subsidi (25 kg)',
                'slug' => 'pupuk-npk-majemuk-non-subsidi',
                'deskripsi' => 'Mendukung pemupukan dasar hingga fase pengisian bulir secara merata.',
                'harga' => 195000,
                'persen_diskon' => 10,
                'stok' => 90,
                'produk_subsidi' => false,
                'bisa_cod' => true,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => $katProteksi->id,
                'nama' => 'Paket Pengendali Wereng & Bercak Terdaftar',
                'slug' => 'paket-pengendali-wereng-bercak',
                'deskripsi' => 'Pestisida terdaftar resmi yang dapat disesuaikan dosisnya bersama Mantri Tani.',
                'harga' => 115000,
                'persen_diskon' => 15,
                'stok' => 75,
                'produk_subsidi' => false,
                'bisa_cod' => true,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => $katProteksi->id,
                'nama' => 'Tangki Semprot Elektrik 16L Bergaransi',
                'slug' => 'tangki-semprot-elektrik-16l',
                'deskripsi' => 'Alsintan bergaransi untuk penyemprotan merata dan perawatan lahan lebih hemat tenaga.',
                'harga' => 420000,
                'persen_diskon' => 10,
                'stok' => 30,
                'produk_subsidi' => false,
                'bisa_cod' => true,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 4. Panduan Dosis Pupuk (Kalkulator Pupuk)
        $dosis = [
            [
                'jenis_tanaman' => 'Padi sawah',
                'kode_tanaman' => 'padi',
                'dosis_organik_kg_ha' => 2000,
                'dosis_urea_kg_ha' => 250,
                'dosis_npk_kg_ha' => 300,
                'tahap_pemberian' => [
                    'Pemupukan dasar (0 sampai 7 HST): berikan seluruh pupuk organik dan 50% NPK saat olah tanah.',
                    'Susulan pertama (14 sampai 21 HST): taburkan 50% Urea dan sisa 50% NPK secara merata.',
                    'Susulan kedua (35 sampai 42 HST): berikan sisa 50% Urea menjelang fase bunting.',
                ],
                'catatan_ahli' => 'Sesuaikan dosis dengan kondisi warna daun (BWD) dan ketersediaan air.',
            ],
            [
                'jenis_tanaman' => 'Jagung pipil',
                'kode_tanaman' => 'jagung',
                'dosis_organik_kg_ha' => 2500,
                'dosis_urea_kg_ha' => 300,
                'dosis_npk_kg_ha' => 300,
                'tahap_pemberian' => [
                    'Pemupukan dasar (saat tanam): pupuk organik di lubang tanam ditambah 50% NPK.',
                    'Susulan pertama (15 HST): berikan 50% Urea dan 50% NPK di samping barisan tanaman.',
                    'Susulan kedua (35 HST): berikan sisa 50% Urea sebelum pembumbunan.',
                ],
                'catatan_ahli' => 'Pastikan tanah lembap saat pemupukan susulan agar pupuk mudah terserap.',
            ],
            [
                'jenis_tanaman' => 'Cabai rawit merah',
                'kode_tanaman' => 'cabai',
                'dosis_organik_kg_ha' => 10000,
                'dosis_urea_kg_ha' => 200,
                'dosis_npk_kg_ha' => 450,
                'tahap_pemberian' => [
                    'Olah bedengan (7 hari sebelum tanam): campurkan pupuk organik matang dan 40% NPK.',
                    'Fase vegetatif (14 sampai 35 HST): kocor atau tugal Urea bertahap setiap 10 hari.',
                    'Fase generatif (mulai berbunga): lanjutkan sisa NPK tinggi kalium agar buah tidak rontok.',
                ],
                'catatan_ahli' => 'Hindari kelebihan nitrogen saat musim hujan untuk mencegah rontok bunga.',
            ],
            [
                'jenis_tanaman' => 'Bawang merah',
                'kode_tanaman' => 'bawang',
                'dosis_organik_kg_ha' => 5000,
                'dosis_urea_kg_ha' => 200,
                'dosis_npk_kg_ha' => 400,
                'tahap_pemberian' => [
                    'Pupuk dasar (3 sampai 5 hari sebelum tanam): sebarkan pupuk organik dan 50% NPK di bedengan.',
                    'Susulan pertama (15 HST): aplikasikan 50% Urea dan 25% NPK.',
                    'Susulan kedua (30 HST): aplikasikan sisa 50% Urea dan 25% NPK untuk pembesaran umbi.',
                ],
                'catatan_ahli' => 'Siram merata setelah pemupukan agar umbi tidak terbakar pupuk.',
            ],
        ];

        foreach ($dosis as $item) {
            PanduanDosisPupuk::create($item);
        }

        // 5. Komoditas & Harga Pasar 07.00 WIB
        $waktuPagi = now()->setTime(7, 0, 0);
        $dataHarga = [
            ['nama' => 'Cabai rawit merah', 'kode' => 'cabai', 'pasar' => 'Rata-rata pasar induk', 'harga' => 48500, 'sebelum' => 47300, 'persen' => 2.50, 'arah' => 'naik'],
            ['nama' => 'Gabah kering panen (GKP)', 'kode' => 'gkp', 'pasar' => 'Rata-rata pengepul & pasar induk', 'harga' => 7200, 'sebelum' => 7130, 'persen' => 1.00, 'arah' => 'naik'],
            ['nama' => 'Bawang merah brebes', 'kode' => 'bawang', 'pasar' => 'Rata-rata pasar induk', 'harga' => 32000, 'sebelum' => 32500, 'persen' => -1.50, 'arah' => 'turun'],
            ['nama' => 'Jagung pipil kering', 'kode' => 'jagung', 'pasar' => 'Rata-rata pasar induk', 'harga' => 5800, 'sebelum' => 5800, 'persen' => 0.00, 'arah' => 'tetap'],
        ];

        foreach ($dataHarga as $row) {
            $komoditas = Komoditas::create([
                'nama' => $row['nama'],
                'kode' => $row['kode'],
                'satuan' => 'kg',
                'aktif' => true,
            ]);

            HargaKomoditas::create([
                'komoditas_id' => $komoditas->id,
                'nama_pasar' => $row['pasar'],
                'harga_per_kg' => $row['harga'],
                'harga_sebelumnya' => $row['sebelum'],
                'persen_perubahan' => $row['persen'],
                'arah_harga' => $row['arah'],
                'waktu_pencatatan' => $waktuPagi,
            ]);
        }

        // 6. Ensiklopedi Penyakit
        $penyakit = [
            [
                'jenis_tanaman' => 'Padi',
                'nama_penyakit' => 'Wereng Batang',
                'slug' => 'wereng-batang-padi',
                'ringkasan' => 'Menyerang pangkal rumpun dan menyebabkan tanaman menguning cepat hingga kering (hopperburn).',
                'gejala' => 'Daun bawah menguning dari ujung, pangkal batang tampak serangga kecil berkerumun.',
                'langkah_awal' => ['Periksa pangkal rumpun setiap pagi.', 'Keringkan petakan sawah sementara selama 3 hari.', 'Konsultasikan dosis insektisida terdaftar ke Mantri Tani.'],
            ],
            [
                'jenis_tanaman' => 'Padi',
                'nama_penyakit' => 'Bercak Daun & Busuk Batang',
                'slug' => 'bercak-daun-busuk-batang-padi',
                'ringkasan' => 'Bercak cokelat pada helai daun dan pelepah bawah yang menghambat pengisian bulir.',
                'gejala' => 'Bintik cokelat lonjong bertepi kuning pada daun serta pelepah bawah kehitaman.',
                'langkah_awal' => ['Kurangi pupuk nitrogen berlebih.', 'Pastikan pembuangan air sawah lancar.', 'Kirim foto daun sakit ke Mantri Tani untuk rekomendasi fungisida.'],
            ],
            [
                'jenis_tanaman' => 'Jagung',
                'nama_penyakit' => 'Busuk Batang Jagung',
                'slug' => 'busuk-batang-jagung',
                'ringkasan' => 'Pangkal batang lunak kecokelatan sehingga tanaman mudah patah sebelum tongkol matang.',
                'gejala' => 'Pangkal batang berubah warna cokelat, lunak, dan daun mendadak layu.',
                'langkah_awal' => ['Bersihkan sisa tanaman terinfeksi dari bedengan.', 'Perbaiki saluran drainase saat hujan tinggi.', 'Gunakan benih bersertifikat tahan penyakit pada musim berikutnya.'],
            ],
            [
                'jenis_tanaman' => 'Cabai',
                'nama_penyakit' => 'Virus Kuning (Gemini)',
                'slug' => 'virus-kuning-cabai',
                'ringkasan' => 'Daun muda menguning keriting dan pertumbuhan pucuk terhambat akibat kutu kebul.',
                'gejala' => 'Tulang daun menguning jelas, helai daun mengeriting ke atas, buah mengecil.',
                'langkah_awal' => ['Cabut tanaman terinfeksi berat agar tidak menular.', 'Kendalikan kutu kebul di bagian bawah daun.', 'Konsultasikan jadwal semprot ke Ahli Hortikultura Solutan.'],
            ],
        ];

        foreach ($penyakit as $p) {
            EnsiklopediPenyakit::create($p);
        }

        // 7. Pengumuman Beranda (Banner Berjalan)
        PengumumanBeranda::insert([
            [
                'label_promo' => 'Promo musim tanam',
                'judul' => 'Diskon hingga 35% untuk benih unggul dan pupuk organik',
                'deskripsi' => 'Dapatkan benih bersertifikat tahan hama dan pupuk penyubur langsung ke desa Anda dengan garansi keaslian 100%.',
                'teks_tombol' => 'Belanja pupuk dan benih',
                'tujuan_tombol' => '#toko',
                'urutan' => 1,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label_promo' => 'Deteksi foto daun',
                'judul' => 'Daun padi bercak? Kirim fotonya ke Mantri Tani',
                'deskripsi' => '42 ahli pertanian online membalas rata-rata dalam 5 menit, lengkap dengan obat dan dosis yang tepat.',
                'teks_tombol' => 'Kirim foto daun sekarang',
                'tujuan_tombol' => '#deteksi',
                'urutan' => 2,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label_promo' => 'Harga pasar naik',
                'judul' => 'Gabah kering panen Rp7.200/kg, naik 1,0%',
                'deskripsi' => 'Cek harga cabai, bawang, gabah, dan jagung sebelum menjual panen supaya tidak rugi.',
                'teks_tombol' => 'Lihat harga pasar',
                'tujuan_tombol' => '#harga',
                'urutan' => 3,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}