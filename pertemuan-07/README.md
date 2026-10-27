yang saya lakukan di pertemuan-07:
1. menyalin artefak pertemuan-06 ke pertemuan-07.
2. saat membuka http://localhost/pwd/0344300002-PWD-TI1A-2627O/pertemuan-07/, hasilnya sama dengan http://localhost/pwd/0344300002-PWD-TI1A-2627O/pertemuan-06/ ini menunjukkan artefak P6 bisa dilanjutkan sebagai baseline P7.
3. mencoba menerapkan penangkapan parameter dengan method GET http://localhost/pwd/0344300002-PWD-TI1A-2627O/pertemuan-07/?nama=Eklly, hasil ditampilkan pada index.php menggunakan htmlspecialchars().
4. menambahkan contactForm.submit(); pada pertemuan-07\script.js untuk mensubmit form setelah validasi javascript selesai.
5. menyalin berkas pertemuan-07\index.php, kemudian me-rename hasil penyalinan menjadi pertemuan-07\indexGet.php. walau berupa salinan, hasilnya tetap sama dengan index.php.
6. mengubah superglobal $_GET menjadi $_POST pada pertemuan-07\index.php
7. menguji pengisian formulir dengan $_POST dan hasilnya tidak ditampilkan pada URL.
8. menambah cara mengakses data dari beberapa jenis input di pertemuan-07\index.php.
9. mengubah name minat menjadi minat[] di pertemuan-07\index.php, kemudian mengubah pertemuan-07\script.js untuk querySelectorAll topik yang dipilih
10. menambah validasi pesan kesalahan pada pertemuan-07\index.php untuk setiap input agar wajib diisi atau dipilih.
11. validasi tipe data INT dan rentang data angka pada pertemuan-07\index.php untuk semester.
12. menambah validasi array untuk isian pilihan yang valid pada pertemuan-07\index.php untuk input pesan dan minat.
13. melakukan normalisasi dan sanitasi untuk setiap input menggunakan trim() dan (string).
14.  menghapus blok percabangan nama. membuat blok penampil pesan kesalahan. menonaktifkan pemanggilan script.js pada index.php, kemudian menguji submit form dan pesan kesalahan berhasil ditampilkan. setelah pengujian, script.js diaktifkan kembali.
15.  menghasilkan keluaran yang aman dari variabel hasil input form.