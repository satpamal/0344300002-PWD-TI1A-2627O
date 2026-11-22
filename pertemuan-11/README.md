# Pertemuan-11

Pengembangan P11 dilakukan secara bertahap dengan menggunakan artefak P10 sebagai _baseline_. Adapun tahapan yang telah dilakukan adalah sebagai berikut.

### Tahap 1: Menyiapkan Artefak P10 sebagai Baseline

1. Menyalin seluruh artefak P10 ke direktori `pertemuan-11/` sebagai baseline pengembangan P11.
2. Memastikan seluruh berkas P10 yang diperlukan telah tersalin, termasuk `index.php`, `fungsi.php`, `script.js`, `style.css`, dan direktori `img/`.
3. Mempertahankan artefak P10 pada direktori `pertemuan-11/` tanpa mengubah direktori P10.
4. Menjalankan aplikasi P11 melalui localhost.
5. Memastikan tampilan profil, navigasi, dan formulir masih berfungsi seperti pada P10.

**Hasil pengujian:** Aplikasi yang telah dibangun dan dikembangkan sampai P10 berhasil dijalankan kembali pada direktori P11.

### Tahap 2: Membuat Koneksi PHP-MySQL

6. Membuat berkas `koneksi.php` untuk memisahkan konfigurasi koneksi PHP dengan MySQL menggunakan MySQLi.
7. Menentukan parameter koneksi berupa host, username, password, dan nama basis data sesuai konfigurasi MySQL lokal.
8. Menggunakan fungsi `mysqli_connect()` untuk membuat koneksi PHP dengan MySQL.
9. Menambahkan pemeriksaan kondisi kegagalan koneksi agar aplikasi menghentikan proses apabila koneksi tidak berhasil.

**Hasil pemeriksaan:** Berkas `koneksi.php` berhasil dibuat dengan menggunakan MySQLi dan dilengkapi pemeriksaan kegagalan koneksi.

### Tahap 3: Mengintegrasikan Koneksi ke Halaman Utama

10. Mengintegrasikan berkas `koneksi.php` ke dalam `index.php` menggunakan `require_once()`.
11. Memastikan layanan Apache dan MySQL berjalan serta basis data `db_pwd_0344300002` tersedia melalui phpMyAdmin.
12. Mengakses aplikasi P11 melalui localhost untuk memeriksa keberhasilan pemuatan berkas koneksi.
13. Memastikan halaman profil, navigasi, dan formulir tetap tampil seperti pada P10.

**Hasil pengujian:** Berkas `koneksi.php` dapat dimuat tanpa menampilkan pesan kegagalan koneksi. Halaman utama P11 juga berhasil ditampilkan secara normal.

### Tahap 4: Mengambil Data dari Basis Data

14. Membuat kueri `SELECT` untuk mengambil data dari tabel `tbl_kontak_0344300002`.
15. Menjalankan kueri menggunakan fungsi `mysqli_query()`.
16. Memeriksa kegagalan pelaksanaan kueri SELECT.
17. Mengambil hasil kueri sebagai larik asosiatif menggunakan `mysqli_fetch_assoc()`.
18. Menyimpan hasil pengambilan data ke dalam larik `$dataKontak`.
19. Menguji hasil pengambilan data melalui localhost.

**Hasil pengujian:** Kueri SELECT berhasil mengambil dua data kontak dari tabel `tbl_kontak_0344300002`. Setiap data berhasil diperoleh sebagai larik asosiatif dengan sembilan atribut, yaitu `id`, `nama`, `email`, `semester`, `tanggal`, `jenis_pesan`, `minat`, `prodi`, dan `pesan`.

### Tahap 5: Menampilkan Data pada Halaman Web

20. Menonaktifkan pemrosesan dan penyajian hasil formulir berbasis session dari P10.
21. Mengganti penyajian hasil formulir dengan data yang diambil dari basis data MySQL.
22. Menampilkan data hasil SELECT menggunakan elemen HTML.
23. Mengambil setiap atribut dari larik asosiatif menggunakan `foreach`.
24. Mengamankan keluaran HTML menggunakan fungsi `bersihkan()`.
25. Menangani kondisi ketika tabel kontak tidak memiliki data.
26. Menguji penyajian data dan kondisi data tidak tersedia melalui localhost.

**Hasil pengujian:**

- Ketika tabel berisi data, seluruh data kontak berhasil ditampilkan pada bagian hasil di bawah formulir.
- Ketika tabel tidak memiliki data, aplikasi menampilkan pesan: `Belum ada data kontak yang tersimpan.`

### Tahap 6: Menguji Penanganan Kegagalan

27. Menguji penanganan kegagalan koneksi PHP-MySQL menggunakan MySQLi dengan nama basis data yang tidak tersedia.
28. Menguji penanganan kegagalan kueri SELECT menggunakan nama tabel yang tidak tersedia.
29. Mengembalikan konfigurasi koneksi dan kueri SELECT ke kondisi semula, kemudian memastikan aplikasi berjalan normal kembali.

**Hasil pengujian:**

- **Kegagalan koneksi:** Aplikasi menampilkan peringatan PHP `Unknown database 'db_tidak_tersedia'`, kemudian menampilkan pesan `Koneksi ke basis data gagal.`
- **Kegagalan kueri SELECT:** Aplikasi menampilkan pesan `Kueri SELECT gagal dijalankan.`
- **Pemulihan aplikasi:** Setelah konfigurasi dikembalikan, aplikasi dapat menampilkan halaman dan data kontak secara normal.

### Membersihkan jejak pertemuan sebelumnya pada berkas:

30. db_pwd_nim.sql
31. index.php

### Kesimpulan

Pengembangan P11 telah menerapkan integrasi PHP dengan MySQL menggunakan MySQLi untuk mengambil dan menampilkan data kontak dari basis data. Implementasi mencakup penggunaan berkas koneksi terpisah, kueri SELECT, pengambilan data menggunakan `mysqli_fetch_assoc()`, pengamanan keluaran HTML, serta penanganan kegagalan koneksi, kegagalan kueri, dan kondisi tabel tanpa data.

Pengujian melalui localhost menunjukkan bahwa proses pengambilan dan penyajian data berjalan sesuai dengan kebutuhan P11.
