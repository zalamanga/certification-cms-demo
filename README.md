# Certification CMS Demo

Demo portal sertifikasi dengan blog dan skema kompetensi beserta persyaratan serta metode asesmen.

## Yang tersedia

- Halaman blog, profil, sertifikasi, dan rincian skema.
- Skema dengan unit kompetensi, dokumen, persyaratan, metode asesmen, serta pemeliharaan.
- Form pendaftaran dan login yang menggunakan koneksi PDO yang sama dengan modul skema.

## Menjalankan demo

PHP 8 dengan ekstensi PDO MySQL, mbstring, DOM/XML, dan GD untuk pengolahan gambar, serta MySQL/MariaDB. Proyek ini tidak membutuhkan Composer.

1. Buat database demo MySQL/MariaDB dengan charset utf8mb4.
2. Impor `database/schema.sql` melalui Adminer/phpMyAdmin atau klien MySQL. Skema tidak berisi akun atau data operasional.
3. Salin `.env.example` menjadi `.env`, lalu isi DB_NAME, DB_USER, DB_PASSWORD, dan alamat database lokal.
4. Dari root proyek, jalankan `php -S 127.0.0.1:8000` dan buka `http://127.0.0.1:8000`. Server bawaan PHP hanya untuk latihan lokal.
5. Buat akun demo sendiri melalui register.php; jangan menggunakan identitas atau dokumen pribadi.

## Struktur yang perlu dibaca

`config.php` atau `db.php` membuka koneksi database; `bootstrap_env.php` membaca konfigurasi lokal; `database/schema.sql` mendefinisikan tabel kosong. Halaman PHP berisi alur aplikasi dan HTML yang masih mengikuti struktur legacy.

## Batas implementasi

- Sumber lama mencampur mysqli dengan koneksi PDO. Salinan publik menyesuaikan login dan pendaftaran menjadi prepared statement PDO serta password hash.
- Area admin dan endpoint blog/skema belum memiliki penjagaan akses yang konsisten. Gunakan sebagai prototype lokal sampai autentikasi dan CSRF ditinjau menyeluruh.
- Skema database dibuat dari kolom yang dipakai query; tidak ada data akun, blog, sertifikat, atau dokumen pribadi yang disertakan.
- Folder sumber dksassets yang sebelumnya tercatat sudah tidak tersedia; aset yang hilang tidak diganti dengan isi rekaan. Tidak ada lisensi proyek yang dipastikan.

## Pemeriksaan publikasi

- PHP lint: 16/16 berkas PHP non-Blade lolos menggunakan PHP 8.1.12.
- Salinan publik tidak menyertakan .env aktual, dependency Composer/Node, log, database dump, arsip, sesi, atau unggahan lokal.
- Tes framework, koneksi database, pengoperasian UI, build aset, dan API eksternal belum dijalankan pada salinan ini. Lint hanya memeriksa sintaks; tidak membuktikan seluruh fitur berfungsi.

## Asal source dan lisensi

Disiapkan dari salinan lokal certification-cms-demo/dks. Tidak ada URL upstream yang dipastikan dari metadata Git untuk proyek ini. Jangan menganggap lisensi framework atau aset otomatis melisensikan seluruh kode proyek.

Aset UI statis yang dirujuk aplikasi tetap disertakan beserta lisensi yang tersedia. Konten merek dan gambar mengikuti hak pemilik aslinya. Perubahan untuk publikasi ini meliputi dokumentasi, pemisahan konfigurasi lokal, skema demo bila diperlukan, dan koreksi terbatas yang dicatat pada persiapan proyek.
