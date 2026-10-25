const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");

navToggle.addEventListener("click", () => {
  const isOpen = navMenu.classList.toggle("nav-open");

  navToggle.setAttribute("aria-expanded", isOpen);

  if (isOpen) {
    navToggle.setAttribute("aria-label", "Tutup navigasi");
  } else {
    navToggle.setAttribute("aria-label", "Buka navigasi");
  }
});

const contactForm = document.getElementById("contactForm");
const formFeedback = document.getElementById("formFeedback");

const namaInput = document.getElementById("nama");
const emailInput = document.getElementById("email");
const semesterInput = document.getElementById("semester");
const tanggalInput = document.getElementById("tanggal");
const prodiInput = document.getElementById("prodi");
const pesanInput = document.getElementById("pesan");

contactForm.addEventListener("submit", (event) => {
  const nama = namaInput.value.trim();
  const email = emailInput.value.trim();
  const semester = Number(semesterInput.value);
  const tanggal = tanggalInput.value;
  const jenisPesan = document.querySelector(
    'input[name="jenis_pesan"]:checked',
  );
  const minatHtml = document.getElementById("minat-html").checked;
  const minatCss = document.getElementById("minat-css").checked;
  const prodi = prodiInput.value;
  const pesan = pesanInput.value.trim();

  formFeedback.className = "form-feedback-error";

  if (nama.length < 3 || nama.length > 50) {
    event.preventDefault();
    formFeedback.textContent = "Nama lengkap harus diisi 3 sampai 50 karakter.";
    return;
  }

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailPattern.test(email)) {
    event.preventDefault();
    formFeedback.textContent = "Masukkan alamat email yang valid.";
    return;
  }

  if (semesterInput.value === "" || semester < 1 || semester > 14) {
    event.preventDefault();
    formFeedback.textContent = "Semester harus diisi dengan angka 1 sampai 14.";
    return;
  }

  if (tanggal === "") {
    event.preventDefault();
    formFeedback.textContent = "Tanggal kunjungan harus diisi.";
    return;
  }

  if (!jenisPesan) {
    event.preventDefault();
    formFeedback.textContent = "Pilih jenis pesan.";
    return;
  }

  if (!minatHtml && !minatCss) {
    event.preventDefault();
    formFeedback.textContent = "Pilih minimal satu topik yang diminati.";
    return;
  }

  if (prodi === "") {
    event.preventDefault();
    formFeedback.textContent = "Pilih program studi.";
    return;
  }

  if (pesan.length === 0) {
    event.preventDefault();
    formFeedback.textContent = "Pesan harus diisi.";
    return;
  }

  if (pesan.length > 300) {
    event.preventDefault();
    formFeedback.textContent = "Pesan maksimal 300 karakter.";
    return;
  }

  formFeedback.textContent = "Data lolos validasi sisi klien; mengirim ke PHP untuk validasi sisi peladen.";
  formFeedback.className = "form-feedback-success";
});

contactForm.addEventListener("reset", () => {
  formFeedback.textContent = "";
});

contactForm.addEventListener("input", () => {
  formFeedback.textContent = "";
});
