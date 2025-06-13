<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Panduan</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/Panduan.css" />
</head>

<body>
    <header>
        <!-- navbar section -->
        <x-navbar></x-navbar>
    </header>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <button class="close-btn" id="close-sidebar">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <ul class="sidebar-menu">
            <li><a href="index.html">Home</a></li>
            <li><a href="cariAktivitas.html">Cari Event</a></li>
            <li><a href="AboutUs.html">About Us</a></li>
            <li class="sidebar-profile">
                <span id="sidebarProfileToggle">Profile ▾</span>
                <ul class="sidebar-profile-dropdown">
                    <li><a href="#">Edit Profil</a></li>
                    <li><a href="tiketSaya.html">Riwayat Tiket</a></li>
                    <li><a href="index.html">Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- content -->
    <div class="guide">
        <h2>Panduan untuk Membeli Tiket</h2>
        <p>Sudah mengerti tahapannya?</p>
        <a href="cariAktivitas.html" class="btn-primary">Beli Tiket</a>
    </div>
    <section class="guide-container">
        <!-- step1 -->
        <div class="step-box">
            <div class="step-title">
                <span>1</span> Masuk atau Daftar Akun
            </div>
            <div class="step-content">
                <p>Klik menu Daftar atau Masuk, lalu lengkapi email dan password. Setelah itu kamu akan diarahkan
                    kembali ke halaman utama.</p>
                <img src="{{ asset('img/panduan1.png') }}" alt="step1" class="step-image">
            </div>
        </div>

        <!-- step2 -->
        <div class="step-box">
            <div class="step-title">
                <span>2</span> Cari Event
            </div>
            <div class="step-content">
                <p>Dari halaman utama, pilih menu Cari Evnet agar dapat melihat daftar kegiatan atau event yang
                    tersedia.</p>
                <img src="{{ asset('img/panduan2.png') }}" alt="step2" class="step-image">
            </div>
        </div>

        <!-- step3 -->
        <div class="step-box">
            <div class="step-title">
                <span>3</span> Pilih Event yang Kamu mau
            </div>
            <div class="step-content">
                <p>Klik salah satu event untuk lihat detailnya: waktu, lokasi, dan informasi lainnya.</p>
                <img src="{{ asset('img/panduan3.png') }}" alt="step3" class="step-image">
            </div>
        </div>

        <!-- step4 -->
        <div class="step-box">
            <div class="step-title">
                <span>4</span> Klik "Beli Tiket"
            </div>
            <div class="step-content">
                <p>Klik salah satu event untuk lihat detailnya: waktu, lokasi, dan informasi lainnya.</p>
                <img src="{{ asset('img/panduan4.png') }}" alt="step4" class="step-image">
            </div>
        </div>

        <!-- step5 -->
        <div class="step-box">
            <div class="step-title">
                <span>5</span> Pilih Jumlah Tiket
            </div>
            <div class="step-content">
                <p>Klik salah satu event untuk lihat detailnya: waktu, lokasi, dan informasi lainnya.</p>
                <img src="{{ asset('img/panduan5.png') }}" alt="step5" class="step-image">
            </div>
        </div>

        <!-- step6 -->
        <div class="step-box">
            <div class="step-title">
                <span>6</span> Isi Data Diri dan Bayar
            </div>
            <div class="step-content">
                <p>Lengkapi data diri kamu, lalu lanjut ke proses pembayaran sesuai nominal yang tertera</p>
                <img src="{{ asset('img/panduan6.png') }}" alt="step6" class="step-image">
            </div>
        </div>

        <!-- step7 -->
        <div class="step-box">
            <div class="step-title">
                <span>7</span> Dapatkan Booking ID
            </div>
            <div class="step-content">
                <p>Setelah pembayaran berhasil, tiket dan booking ID akan langsung muncul di layar.</p>
                <img src="{{ asset('img/panduan7.png') }}" alt="step7" class="step-image">
            </div>
        </div>

        <!-- step8 -->
        <div class="step-box">
            <div class="step-title">
                <span>8</span> Lihat Tiket di Profil
            </div>
            <div class="step-content">
                <p>Semua tiket yang kamu beli bisa dicek di menu Tiket lewat halaman profil. Ada juga Riwayat Tiket agar
                    kamu dapat melihat aktivitas sebelumnya.</p>
                <img src="{{ asset('img/panduan8.png') }}" alt="step8" class="step-image">
            </div>
        </div>

        <div class="guide-foot">
            <p>Sudah mengerti tahapannya?</p>
            <a href="{{ route('landing.cariEvent') }}" class="btn-primary">Beli Tiket</a>
        </div>
    </section>

    <!-- footer section -->
    <footer class="footer">
        <x-footer></x-footer>
    </footer>

    <script src="js/navigasi.js"></script>
</body>

</html>
