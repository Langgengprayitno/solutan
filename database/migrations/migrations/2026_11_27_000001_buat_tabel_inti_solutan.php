<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Pengguna (petani perorangan, ahli/mantri tani, admin)
        Schema::create('pengguna', function (Blueprint $table): void {
            $table->id();
            $table->string('nama', 120);
            $table->string('no_hp', 20)->unique();
            $table->string('kata_sandi');
            $table->enum('peran', ['petani', 'ahli', 'admin'])->default('petani')->index();
            $table->string('desa', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 100)->nullable();
            $table->text('alamat_pengiriman')->nullable();
            $table->string('foto_profil')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Profil Ahli / Mantri Tani Aktif
        Schema::create('profil_ahli', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('pengguna_id')->unique()->constrained('pengguna')->cascadeOnDelete();
            $table->string('spesialisasi', 150);
            $table->string('bidang_fokus')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('sedang_online')->default(true)->index();
            $table->unsignedSmallInteger('rata_rata_balas_menit')->default(5);
            $table->timestamps();
        });

        // 3. Konsultasi (tiket Tanya Ahli & Deteksi Penyakit)
        Schema::create('konsultasi', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('petani_id')->constrained('pengguna')->cascadeOnDelete();
            $table->foreignId('ahli_id')->nullable()->constrained('pengguna')->nullOnDelete();
            $table->string('jenis_tanaman', 60);
            $table->text('ringkasan_gejala');
            $table->enum('status', ['menunggu', 'aktif', 'selesai'])->default('menunggu')->index();
            $table->timestamps();
        });

        // 4. Pesan Konsultasi (chat + kirim foto daun/batang)
        Schema::create('pesan_konsultasi', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('konsultasi_id')->constrained('konsultasi')->cascadeOnDelete();
            $table->foreignId('pengirim_id')->constrained('pengguna')->cascadeOnDelete();
            $table->text('isi_pesan')->nullable();
            $table->string('foto_tanaman')->nullable();
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamps();
        });

        // 5. Kategori Produk Toko Tani
        Schema::create('kategori_produk', function (Blueprint $table): void {
            $table->id();
            $table->string('nama', 100);
            $table->string('slug', 120)->unique();
            $table->timestamps();
        });

        // 6. Produk Toko Tani
        Schema::create('produk', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_produk')->restrictOnDelete();
            $table->string('nama', 160);
            $table->string('slug', 180)->unique();
            $table->text('deskripsi');
            $table->unsignedInteger('harga');
            $table->unsignedTinyInteger('persen_diskon')->default(0);
            $table->unsignedInteger('stok')->default(0);
            $table->boolean('produk_subsidi')->default(false);
            $table->boolean('bisa_cod')->default(true);
            $table->string('foto_produk')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 7. Pesanan COD Petani
        Schema::create('pesanan', function (Blueprint $table): void {
            $table->id();
            $table->string('kode_pesanan', 40)->unique();
            $table->foreignId('pengguna_id')->constrained('pengguna')->cascadeOnDelete();
            $table->string('metode_bayar', 30)->default('cod');
            $table->unsignedInteger('ongkir')->default(0);
            $table->unsignedBigInteger('total_bayar');
            $table->text('alamat_kirim');
            $table->string('catatan')->nullable();
            $table->enum('status', ['menunggu_konfirmasi', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])
                ->default('menunggu_konfirmasi')
                ->index();
            $table->timestamps();
        });

        // 8. Detail Pesanan
        Schema::create('detail_pesanan', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('produk')->restrictOnDelete();
            $table->unsignedSmallInteger('jumlah');
            $table->unsignedInteger('harga_satuan');
            $table->unsignedBigInteger('subtotal');
            $table->timestamps();
        });

        // 9. Panduan Dosis Pupuk (Kalkulator Pupuk)
        Schema::create('panduan_dosis_pupuk', function (Blueprint $table): void {
            $table->id();
            $table->string('jenis_tanaman', 60);
            $table->string('kode_tanaman', 40)->unique();
            $table->unsignedInteger('dosis_organik_kg_ha');
            $table->unsignedInteger('dosis_urea_kg_ha');
            $table->unsignedInteger('dosis_npk_kg_ha');
            $table->json('tahap_pemberian');
            $table->text('catatan_ahli')->nullable();
            $table->timestamps();
        });

        // 10. Komoditas Pasar
        Schema::create('komoditas', function (Blueprint $table): void {
            $table->id();
            $table->string('nama', 100);
            $table->string('kode', 40)->unique();
            $table->string('satuan', 20)->default('kg');
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // 11. Harga Komoditas Harian (07.00 WIB)
        Schema::create('harga_komoditas', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('komoditas_id')->constrained('komoditas')->cascadeOnDelete();
            $table->string('nama_pasar', 120)->default('Rata-rata pasar induk');
            $table->unsignedInteger('harga_per_kg');
            $table->unsignedInteger('harga_sebelumnya')->nullable();
            $table->decimal('persen_perubahan', 5, 2)->default(0);
            $table->enum('arah_harga', ['naik', 'turun', 'tetap'])->default('tetap');
            $table->dateTime('waktu_pencatatan')->index();
            $table->timestamps();
        });

        // 12. Ensiklopedi Penyakit Tanaman
        Schema::create('ensiklopedi_penyakit', function (Blueprint $table): void {
            $table->id();
            $table->string('jenis_tanaman', 60)->index();
            $table->string('nama_penyakit', 150);
            $table->string('slug', 170)->unique();
            $table->text('ringkasan');
            $table->text('gejala');
            $table->json('langkah_awal');
            $table->string('foto_penyakit')->nullable();
            $table->timestamps();
        });

        // 13. Pengumuman Beranda (Banner Berjalan)
        Schema::create('pengumuman_beranda', function (Blueprint $table): void {
            $table->id();
            $table->string('label_promo', 80);
            $table->string('judul', 180);
            $table->text('deskripsi');
            $table->string('teks_tombol', 80);
            $table->string('tujuan_tombol', 120);
            $table->unsignedTinyInteger('urutan')->default(1)->index();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman_beranda');
        Schema::dropIfExists('ensiklopedi_penyakit');
        Schema::dropIfExists('harga_komoditas');
        Schema::dropIfExists('komoditas');
        Schema::dropIfExists('panduan_dosis_pupuk');
        Schema::dropIfExists('detail_pesanan');
        Schema::dropIfExists('pesanan');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('kategori_produk');
        Schema::dropIfExists('pesan_konsultasi');
        Schema::dropIfExists('konsultasi');
        Schema::dropIfExists('profil_ahli');
        Schema::dropIfExists('pengguna');
    }
};