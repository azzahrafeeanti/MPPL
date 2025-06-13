<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TapakAsa</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  </head>
  <body>
    <header>
      <!-- navbar section -->
      <x-navbar></x-navbar>
    </header>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <h2>Masuk ke Akunmu</h2>
        <p>Untuk menggunakan semua fitur di TapakAsa</p>
        <div class="sidebar-auth">
          <a href="{{route('landing.signUp')}}" class="btn outline-btn">Daftar</a>
          <a href="{{route('landing.signIn')}}" class="btn fill-btn">Masuk</a>
        </div>
        <button class="close-btn" id="close-sidebar">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
      <x-sidebar></x-sidebar>
    </div>


    <!-- hero section -->
    <section class="hero" id="hero">
      <div class="hero-content">
        <h1>
          Tinggalkan <br />
          Jejak. Tebarkan <br />
          Harapan
        </h1>
        <p>
          Setiap langkah kecilmu adalah cahaya <br />
          besar bagi mereka yang membutuhkan
        </p>
        <a href="{{route('landing.aboutUs')}}" class="cta-button">Baca Selengkapnya</a>
      </div>
    </section>

    <section class="stats-cards">
      <div class="card small-card">
        <div class="icon-text">
          <img src="{{ asset('icons/relawan.svg') }}" alt="relawan">
          <div class="text-content">
            <div class="number">603.005</div>
            <div class="label">Relawan</div>
          </div>
        </div>
      </div>
      <div class="card small-card">
        <div class="icon-text">
          <img src="{{ asset('icons/aktivitas.svg') }}" alt="">
          <div class="text-content">
            <div class="number">603.005</div>
            <div class="label">Aktivitas</div>
          </div>
        </div>
      </div>
    </section>

    <!-- layanan section -->
    <section class="layanan-section" id="layanan">
      <div class="container layanan-container">
        <h3 class="section-title">
          Kenali Layanan TapakAsa <br />
          untuk Langkah Awal Kebaikanmu
        </h3>
        <div class="layanan-cards">
          <div class="layanan-card">
            <img src="{{ asset('icons/jdrelawan.svg') }}" alt="jadi relawan">
            <h3>Jadi Relawan</h3>
            <p>
              Baru memulai untuk jadi relawan? <br> Pelajari selangkapnya dan mulai cari aktivitas kerelawanan pertamamu!
            </p>
            <a href="{{route('landing.cariEvent')}}" class="btn layanan-btn"
              >Cari Aktivitas</a
            >
          </div>
          <div class="layanan-card">
            <img src="{{ asset('icons/csr.svg') }}" alt="csr">
            <h3>Kerjasama CSR</h3>
            <p>
              Tingkatkan dampak program CSR perusahaan bersama kami dengan melibatkan komunitas lokal dan relawan!
            </p>
            <a href="{{route('landing.csr')}}" class="btn layanan-btn">Baca Selengkapnya</a>
          </div>
          <div class="layanan-card">
            <img src="{{ asset('icons/carirelawan.svg') }}" alt="cari relawan">
            <h3>Lihat Panduan</h3>
            <p>Kurang memahami bagaimana menggunakan web TapakAsa? Silakan klik tombol berikut</p>
            <a href="{{ route('landing.panduan') }}" class="btn layanan-btn">Lihat Panduan</a>
          </div>
        </div>
      </div>
    </section>

    <!-- aktivitas section -->
    <section class="aktivitas-section d-flex" id="aktivitas">
      <div class="container aktivitas-container">
        <h3 class="section-title aktivitas-judul">
          Ada Aktivitas Perlu Bantuan Kamu Nih!
        </h3>
        <p class="section-subtitle">
          Pilih aktivitas kerelawanan sesuai lokasi, minat, dan isu yang kamu
          sukai
        </p>
        <div class="d-flex flex-row aktivitas-cards">
          @foreach ( $events as $event )
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
              <div class="aktivitas-card">
                <img
                  src="{{ url('storage', $event->photo) }}"
                  alt="Aktivitas 1"
                  class="aktivitas-image"
                />
                <h4 class="aktivitas-title">{{ $event->name }}</h4>
                <p class="aktivitas-date">{{ Date::parse($event->date)->format('j F Y') }}</p>
                <p class="aktivitas-price">{{ Number::currency($event->price, 'IDR') }}</p>
              </div>
            </div>
          @endforeach
        </div>
          
        <a href="{{route('landing.cariEvent')}}" class="btn aktivitas-btn">Lihat Aktivitas Lain</a>
      </div>
    </section>

    <!-- Section Footer -->
    <x-footer></x-footer>

    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
