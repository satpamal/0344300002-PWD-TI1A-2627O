# Pertemuan-11

Saya melakukan hal sebagai berikut untuk P11:

1. Menyalin seluruh artefak P10 ke direktori `pertemuan-11/` sebagai baseline pengembangan P11.
2. Memastikan seluruh berkas P10 yang diperlukan telah tersalin, termasuk `index.php`, `fungsi.php`, `script.js`, `style.css`, dan direktori `img/`.
3. Mempertahankan artefak P10 pada direktori `pertemuan-11/` tanpa perubahan.
4. Memeriksa hasil penyalinan dan menjalankan aplikasi P11 melalui localhost.
5. Memastikan tampilan profil, navigasi, dan formulir masih berfungsi seperti pada P10.

**Hasil pemeriksaan:** Aplikasi yang telah dibangun dan dikembangkan sampai P10, masih berfungsi dengan baik di P11.

6. Membuat berkas `koneksi.php` untuk memisahkan konfigurasi koneksi PHP dengan MySQL menggunakan MySQLi.
7. Menentukan parameter koneksi berupa host, username, password, dan nama basis data sesuai konfigurasi MySQL lokal.
8. Menggunakan fungsi `mysqli_connect()` untuk membuat koneksi PHP dengan MySQL.
9. Menambahkan pemeriksaan kondisi kegagalan koneksi agar aplikasi dapat menghentikan proses apabila koneksi tidak berhasil.

**Hasil pemeriksaan:** Berkas `koneksi.php` telah dibuat. Pengujian keberhasilan koneksi akan dilakukan pada tahap integrasi dengan `index.php`.

10. Mengintegrasikan berkas `koneksi.php` ke dalam `index.php` menggunakan `require_once()` agar halaman utama dapat menggunakan koneksi PHP-MySQL.
11. Memastikan layanan Apache dan MySQL berjalan serta basis data `db_pwd_0344300002` tersedia melalui phpMyAdmin.
12. Mengakses aplikasi P11 melalui localhost untuk memeriksa keberhasilan pemuatan berkas koneksi.
13. Memeriksa bahwa halaman profil, navigasi, dan formulir tetap tampil seperti pada P10.

**Hasil pengujian:** saat mengakses URL http://localhost/pwd/0344300002-PWD-TI1A-2627O/pertemuan-11/koneksi.php, hanya tampil jendela putih, hal ini menunjukkan koneksi PHP ke MySQL berhasil. begitu juga saat mengakses URL http://localhost/pwd/0344300002-PWD-TI1A-2627O/pertemuan-11/ tampilan aplikasi tetap normal.
