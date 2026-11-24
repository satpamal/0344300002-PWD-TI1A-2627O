# Dokumentasi P12

DOKUMENTASI PERTEMUAN 12 - Pemrograman Web Dasar

### Tahap 1 - Menyalin Artefak P11 sebagai Baseline P12

1. Menyalin seluruh isi direktori pertemuan-11/ sebagai dasar pengembangan pertemuan-12/.
2. Mempertahankan direktori pertemuan-11/ tanpa melakukan perubahan.
3. Menjadikan direktori pertemuan-12/ sebagai lingkungan pengembangan P12.

Status: Penyalinan artefak P11 telah dilakukan. Belum ada perubahan implementasi fitur.

### Tahap 2 - Pemeriksaan Baseline P12

1. Memeriksa kelengkapan berkas hasil penyalinan artefak P11.
2. Memeriksa koneksi PHP-MySQL pada koneksi.php.
3. Memeriksa penggunaan basis data db_pwd_nim.
4. Memeriksa penggunaan tabel tbl_kontak_nim.
5. Memeriksa sembilan atribut tabel berdasarkan db_pwd_nim.sql.
6. Memeriksa kueri SELECT dan pengambilan data menggunakan mysqli_fetch_assoc() pada index.php.
7. Memeriksa penyajian data hasil READ pada halaman utama.
8. Mengidentifikasi pemrosesan formulir POST yang masih menggunakan session dan belum menyimpan data ke MySQL.

HASIL PEMERIKSAAN: berdasarkan pemeriksaan aktual pada direktori P12 masih bisa bekerja dengan baik.

CATATAN: Belum dilakukan implementasi operasi INSERT. Baseline P11 dipertahankan sebagai dasar pengembangan P12.

### TAHAP 3: PERSIAPAN SESSION

1. Menambahkan session_start() pada bagian awal index.php.
2. Memastikan session diaktifkan sebelum data session digunakan.
3. Mempertahankan fungsi dan koneksi yang sudah tersedia dari artefak P11.

TUJUAN: Menyiapkan mekanisme session untuk pengelolaan old input dan flash message pada proses CREATE P12.

### TAHAP 4: PENGAMBILAN DAN VALIDASI DATA FORMULIR

1. Mengembangkan pemrosesan data formulir menggunakan POST.
2. Mengambil delapan field formulir dengan pemeriksaan tipe data.
3. Menerapkan validasi sisi peladen untuk setiap field.
4. Memeriksa pilihan checkbox HTML dan CSS.
5. Mengubah nilai checkbox menjadi string yang dipisahkan koma.
6. Menyiapkan data formulir dalam larik asosiatif.
7. Menampilkan pesan kesalahan apabila validasi gagal.

CATATAN: Operasi INSERT belum diterapkan. Data yang lolos validasi belum disimpan ke database.

## Penerapan CREATE dengan MySQLi Prepared Statement

Pada tahap ini, formulir kontak dikembangkan agar data yang telah lolos validasi PHP dapat disimpan ke tabel `tbl_kontak_nim`.

Implementasi CREATE menggunakan MySQLi Prepared Statement dengan tahapan:

1. Menggabungkan pilihan topik yang diminati menjadi satu nilai teks.
2. Menyiapkan perintah SQL INSERT menggunakan placeholder.
3. Mengikat nilai formulir ke parameter menggunakan `mysqli_stmt_bind_param()`.
4. Menjalankan perintah INSERT menggunakan `mysqli_stmt_execute()`.
5. Memeriksa keberhasilan penyimpanan data.
6. Menutup statement menggunakan `mysqli_stmt_close()`.

Setelah proses penyimpanan, aplikasi menerapkan pola Post/Redirect/Get (PRG). Jika penyimpanan berhasil, aplikasi menampilkan pesan keberhasilan dan mengosongkan formulir. Jika penyimpanan gagal, aplikasi menampilkan pesan kesalahan dan mempertahankan input pengguna.

Data yang berhasil disimpan dapat diperiksa melalui tabel `tbl_kontak_nim` dan ditampilkan kembali menggunakan fitur READ yang telah dikembangkan pada pertemuan sebelumnya.
