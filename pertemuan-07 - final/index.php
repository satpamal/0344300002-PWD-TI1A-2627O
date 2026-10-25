<?php
// P7: Pemrosesan formulir dengan PHP, validasi sisi peladen, dan PRG
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	// Ambil nilai skalar dan lakukan normalisasi awal.
	$namaMasuk = isset($_POST["nama"]) && is_string($_POST["nama"]) ? trim($_POST["nama"]) : "";
	$namaMasuk = preg_replace('/\s+/', ' ', $namaMasuk);
	$emailMasuk = isset($_POST["email"]) && is_string($_POST["email"]) ? strtolower(trim($_POST["email"])) : "";
	$semesterMasuk = isset($_POST["semester"]) && is_string($_POST["semester"]) ? trim($_POST["semester"]) : "";
	$tanggalMasuk = isset($_POST["tanggal"]) && is_string($_POST["tanggal"]) ? trim($_POST["tanggal"]) : "";
	$jenisPesanMasuk = isset($_POST["jenis_pesan"]) && is_string($_POST["jenis_pesan"]) ? $_POST["jenis_pesan"] : "";
	$minatMasuk = $_POST["minat"] ?? [];

	if (!is_array($minatMasuk)) {
		$minatMasuk = [];
	}

	$minatMasuk = array_intersect($minatMasuk, ["html", "css"]);

	/* $minatHtmlMasuk = isset($_POST["minat_html"]) && $_POST["minat_html"] === "ya" ? "ya" : "";
	$minatCssMasuk = isset($_POST["minat_css"]) && $_POST["minat_css"] === "ya" ? "ya" : ""; */
	$prodiMasuk = isset($_POST["prodi"]) && is_string($_POST["prodi"]) ? $_POST["prodi"] : "";
	$pesanMasuk = isset($_POST["pesan"]) && is_string($_POST["pesan"]) ? trim($_POST["pesan"]) : "";

	// Contoh array asosiatif: satu struktur untuk mengelompokkan data formulir.
	$dataFormulir = [
		"nama" => $namaMasuk,
		"email" => $emailMasuk,
		"semester" => $semesterMasuk,
		"tanggal" => $tanggalMasuk,
		"jenis_pesan" => $jenisPesanMasuk,
		"minat" => $minatMasuk,
		/* "minat_html" => $minatHtmlMasuk,
		"minat_css" => $minatCssMasuk, */
		"prodi" => $prodiMasuk,
		"pesan" => $pesanMasuk
	];

	// Validasi sisi peladen: jangan mengandalkan JavaScript atau atribut HTML saja.
	$errorMessage = "";

	if (strlen($namaMasuk) < 3 || strlen($namaMasuk) > 50) {
		$errorMessage = "Nama lengkap harus diisi 3 sampai 50 karakter.";
	} elseif (!filter_var($emailMasuk, FILTER_VALIDATE_EMAIL)) {
		$errorMessage = "Masukkan alamat email yang valid.";
	} elseif (filter_var($semesterMasuk, FILTER_VALIDATE_INT) === false || (int) $semesterMasuk < 1 || (int) $semesterMasuk > 14) {
		$errorMessage = "Semester harus berupa bilangan bulat 1 sampai 14.";
	} elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggalMasuk) || strtotime($tanggalMasuk) === false || date('Y-m-d', strtotime($tanggalMasuk)) !== $tanggalMasuk) {
		$errorMessage = "Tanggal kunjungan harus diisi dengan tanggal yang valid.";
	} elseif ($jenisPesanMasuk !== "pertanyaan" && $jenisPesanMasuk !== "saran") {
		$errorMessage = "Pilih jenis pesan yang tersedia.";
	} elseif (empty($minatMasuk)) {
		$errorMessage = "Pilih minimal satu topik yang diminati.";
	} elseif ($prodiMasuk !== "SI" && $prodiMasuk !== "TI") {
		$errorMessage = "Pilih program studi yang tersedia.";
	} elseif ($pesanMasuk === "" || strlen($pesanMasuk) > 300) {
		$errorMessage = "Pesan harus diisi dan maksimal 300 karakter.";
	}

	// Simpan data formulir terbaru dalam session pada setiap POST, baik valid maupun tidak.
	// Data ini tetap tersedia sampai diperbarui, dihapus, atau session berakhir.
	$_SESSION["data_formulir"] = $dataFormulir;

	if ($errorMessage !== "") {
		// Data formulir tetap tersimpan untuk mengisi kembali setiap objek form.
		// Hapus ringkasan sukses sebelumnya agar tidak menyesatkan.
		unset($_SESSION["hasil_formulir"]);
		$_SESSION["flash_message"] = $errorMessage;
		$_SESSION["flash_type"] = "error";
	} else {
		// Simpan ringkasan hasil validasi dalam session; tidak disimpan ke basis data.
		$_SESSION["hasil_formulir"] = $dataFormulir;
		$_SESSION["flash_message"] = "Form berhasil divalidasi oleh PHP. Data ditampilkan sebagai contoh array asosiatif dalam session; belum disimpan ke basis data.";
		$_SESSION["flash_type"] = "success";
	}

	// PRG: redirect setelah POST agar pemuatan ulang tidak mengirim POST yang sama.
	header("Location: index.php#contact");
	exit;
}

// Ambil data sementara dari session setelah redirect.
$flashMessage = isset($_SESSION["flash_message"]) && is_string($_SESSION["flash_message"]) ? $_SESSION["flash_message"] : "";
$flashType = isset($_SESSION["flash_type"]) && is_string($_SESSION["flash_type"]) ? $_SESSION["flash_type"] : "";
$dataFormulir = isset($_SESSION["data_formulir"]) && is_array($_SESSION["data_formulir"]) ? $_SESSION["data_formulir"] : [];
$hasilFormulir = isset($_SESSION["hasil_formulir"]) && is_array($_SESSION["hasil_formulir"]) ? $_SESSION["hasil_formulir"] : [];

// Nilai dari array asosiatif session selalu dipetakan kembali ke objek formulir.
$oldNama = $dataFormulir["nama"] ?? "";
$oldEmail = $dataFormulir["email"] ?? "";
$oldSemester = $dataFormulir["semester"] ?? "";
$oldTanggal = $dataFormulir["tanggal"] ?? "";
$oldJenisPesan = $dataFormulir["jenis_pesan"] ?? "";
/* $oldMinatHtml = $dataFormulir["minat_html"] ?? "";
$oldMinatCss = $dataFormulir["minat_css"] ?? ""; */
$oldMinat = $dataFormulir["minat"] ?? [];
$oldProdi = $dataFormulir["prodi"] ?? "";
$oldPesan = $dataFormulir["pesan"] ?? "";

// Flash message hanya ditampilkan sekali; data_formulir dan hasil_formulir tetap ada.
unset($_SESSION["flash_message"], $_SESSION["flash_type"]);

// P6: PHP dasar dan pemrograman sisi peladen
// Bagian 1: Variabel dan konstanta
$nim = "0344300002";
$namaMahasiswa = "Cantika Putih";
$programStudi = "SI";
$tahunAkademik = "2026/2027";
$semester = 4;
$ipk = 3.75;
$statusAktif = true;
$catatanTambahan = null;

const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";
const PROFIL_GITHUB = "satpamal";

// Bagian 2: Operator
$batasSemester = 8;
$sisaSemester = $batasSemester - $semester;
$semesterValid = $semester >= 1 && $semester <= $batasSemester;
$statusSemester = ($semesterValid && $statusAktif) ? "Sesuai rentang" : "Perlu diperiksa";

// Bagian 3: Percabangan if-elseif-else
if ($semester < 3) {
	$keteranganSemester = "Semester awal";
} elseif ($semester <= 6) {
	$keteranganSemester = "Semester menengah";
} else {
	$keteranganSemester = "Semester akhir";
}

$namaProdi = ($programStudi == "SI") ? "Sistem Informasi" : (($programStudi == "TI") ? "Teknik Informatika" : "Lainnya");

// Bagian 4: Percabangan switch-case-default
switch ($programStudi) {
	case "SI":
		$fokusProgramStudi = "Sistem informasi dan proses bisnis";
		break;
	case "TI":
		$fokusProgramStudi = "Komputasi dan pengembangan perangkat lunak";
		break;
	default:
		$fokusProgramStudi = "Belum ditentukan";
}
?>
<!doctype html>
<html lang="id">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Profil Mahasiswa</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<header>
		<div class="header-top">
			<h1>Profil Mahasiswa</h1>

			<button
				class="nav-toggle"
				id="navToggle"
				type="button"
				aria-label="Buka navigasi"
				aria-controls="navMenu"
				aria-expanded="false">
				&#9776;
			</button>
		</div>

		<nav>
			<ul id="navMenu">
				<li><a href="#home">Beranda</a></li>
				<li><a href="#about">Tentang</a></li>
				<li><a href="#contact">Kontak</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<section id="home">
			<h2>Selamat Datang</h2>
			<p>Halo, saya <strong><?php echo $namaMahasiswa; ?></strong>. Saya sedang mempelajari matakuliah <strong><?php print NAMA_MATA_KULIAH; ?></strong> pada tahun akademik <?php echo $tahunAkademik; ?>.</p>

			<img src="img/foto-profil.jpg" alt="Foto profil Nama Mahasiswa" />
		</section>

		<section id="about">
			<h2>Tentang Saya</h2>

			<article>
				<h3>Profil Singkat</h3>
				<p>Program Studi: <?php echo $namaProdi . " (" . $programStudi . ")"; ?></p>
				<p>Fokus program studi: <?php echo $fokusProgramStudi; ?></p>
				<p>Status mahasiswa: <?php echo $statusAktif ? "Aktif" : "Tidak aktif"; ?></p>
				<p>Semester: <?php echo $semester . " (" . $keteranganSemester . ")"; ?></p>
				<p>Sisa semester hingga batas: <?php echo $sisaSemester; ?></p>
				<p>Pemeriksaan rentang semester: <?php echo $statusSemester; ?></p>
				<p>IPK: <?php echo number_format($ipk, 2, ',', '.'); ?></p>
				<p>Catatan tambahan: <?php echo $catatanTambahan === null ? "Belum ada" : $catatanTambahan; ?></p>

				<h3>Target Belajar (Perulangan for)</h3>
				<ol>
					<?php
					// Perulangan for tanpa array; materi larik dibahas pada P9.
					for ($i = 1; $i <= 5; $i++) {
						echo "<li>Target belajar ke-" . $i . ": ";
						switch ($i) {
							case 1:
								echo "Memahami sintaks dasar PHP.";
								break;
							case 2:
								echo "Menggunakan variabel dan konstanta.";
								break;
							case 3:
								echo "Menerapkan operator dan percabangan.";
								break;
							case 4:
								echo "Menggunakan perulangan for dan while.";
								break;
							default:
								echo "Belum dipetakan";
								break;
						}
						echo "</li>";
					}
					?>
				</ol>

				<h3>Semester (Perulangan while):</h3>
				<ol>
					<?php
					$nomorSemester = 1;
					while ($nomorSemester <= 3) {
						echo "<li>Semester " . $nomorSemester . "</li>";
						$nomorSemester++; // operator penugasan
					}
					?>
				</ol>
			</article>
		</section>

		<section id="contact">
			<h2>Kontak</h2>

			<p>
				Kunjungi
				<a target="_blank" href="https://github.com/<?= PROFIL_GITHUB ?>">profil GitHub saya</a>.
			</p>


			<form id="contactForm" action="index.php" method="post" novalidate>
				<div class="form-group">
					<label for="nama">Nama Lengkap</label><br />

					<input
						class="input-form"
						type="text"
						id="nama"
						name="nama"
						placeholder="Masukkan nama lengkap"
						value="<?php echo htmlspecialchars($oldNama, ENT_QUOTES, 'UTF-8'); ?>"
						minlength="3"
						maxlength="50"
						required />
				</div>

				<div class="form-group">
					<label for="email">Email</label><br />

					<input class="input-form" type="email" id="email" name="email" placeholder="nama@email.com" value="<?php echo htmlspecialchars($oldEmail, ENT_QUOTES, 'UTF-8'); ?>" required />
				</div>

				<div class="form-group">
					<label for="semester">Semester</label><br />

					<input class="input-form" type="number" id="semester" name="semester" min="1" max="14" value="<?php echo htmlspecialchars($oldSemester, ENT_QUOTES, 'UTF-8'); ?>" required />
				</div>

				<div class="form-group">
					<label for="tanggal">Tanggal Kunjungan</label><br />

					<input class="input-form" type="date" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($oldTanggal, ENT_QUOTES, 'UTF-8'); ?>" required />
				</div>

				<div class="form-group">
					<p>Jenis Pesan</p>

					<input type="radio" id="pertanyaan" name="jenis_pesan" value="pertanyaan" <?php echo $oldJenisPesan === "pertanyaan" ? "checked" : ""; ?> required />
					<label for="pertanyaan">Pertanyaan</label>

					<input type="radio" id="saran" name="jenis_pesan" value="saran" <?php echo $oldJenisPesan === "saran" ? "checked" : ""; ?> />
					<label for="saran">Saran</label>
				</div>

				<div class="form-group">
					<p>Topik yang Diminati</p>

					<input type="checkbox" id="minat-html" name="minat[]" value="html" <?php echo in_array("html", $oldMinat) ? "checked" : ""; ?> />
					<label for="minat-html">HTML</label>

					<input type="checkbox" id="minat-css" name="minat[]" value="css" <?php echo in_array("css", $oldMinat) ? "checked" : ""; ?> />
					<label for="minat-css">CSS</label>
				</div>

				<div class="form-group">
					<label for="prodi">Program Studi</label><br />

					<select class="input-form" id="prodi" name="prodi" required>
						<option value="">-- Pilih Program Studi --</option>
						<option value="SI" <?php echo $oldProdi === "SI" ? "selected" : ""; ?>>Sistem Informasi</option>
						<option value="TI" <?php echo $oldProdi === "TI" ? "selected" : ""; ?>>Teknik Informatika</option>
					</select>
				</div>

				<div class="form-group">
					<label for="pesan">Pesan</label><br />

					<textarea
						class="input-form"
						id="pesan"
						name="pesan"
						maxlength="300"
						placeholder="Tulis pesan Anda"
						required><?php echo htmlspecialchars($oldPesan, ENT_QUOTES, 'UTF-8'); ?></textarea>
				</div>

				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
				<p id="formFeedback" class="<?php echo htmlspecialchars($flashType === "error" ? "form-feedback-error" : ($flashType === "success" ? "form-feedback-success" : ""), ENT_QUOTES, "UTF-8"); ?>" role="status"><?php echo htmlspecialchars($flashMessage, ENT_QUOTES, "UTF-8"); ?></p>
			</form>
		</section>
	</main>

	<footer>
		<p>&copy; <?= date("Y") ?> <?php echo $namaMahasiswa; ?> [<?= $nim ?>]</p>
	</footer>
	<script src="script.js"></script>
</body>

</html>