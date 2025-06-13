<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>About Us</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/aboutUs.css" />
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
    <section class="about-section">
        <div class="container-about">
            <h2 class="about-title">Tentang TapakAsa</h2>
            <p class="about-text">
                TapakAsa adalah platform volunteering yang mempertemukan individu dan perusahaan dengan berbagai
                kegiatan sosial di seluruh Indonesia.
            </p>
            <p class="about-text">
                Kami hadir untuk menyederhanakan aksi kebaikan—mengubah niat menjadi langkah nyata, dan langkah kecil
                menjadi dampak besar.
            </p>
            <p class="about-text">
                Dengan sistem yang tertata dan akses yang inklusif, TapakAsa membuka jalan bagi siapa pun untuk
                berkontribusi.
            </p>

            <p class="about-text">
                Karena kami percaya: gotong royong adalah kekuatan, dan setiap aksi sosial pantas untuk tumbuh dalam
                ruang yang rapi dan bermakna.
            </p>

            <div class="about-image">
                <img src="{{ asset('img/aboutUs.png') }}" alt="about us">
            </div>
        </div>
    </section>


    <!-- footer section -->
    <footer class="footer">
        <x-footer></x-footer>
    </footer>

    {{-- <script src="js/navigasi.js"></script> --}}
</body>

</html>
