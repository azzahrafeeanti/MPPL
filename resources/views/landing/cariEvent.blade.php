<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>Cari Aktivitas - TapakAsa</title>
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/cariAktivitas.css') }}" />
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

    <div class="page-wrapper">
      <main>
        <div class="search-sort-section">
          <div class="search-left">
            <h2 class="section-title">Cari Event</h2>

            <form class="search-bar" action="{{ route('landing.cariEvent') }}" method="GET" class="search-bar">
              <input type="text" name="search" placeholder="Search" value="{{ $searchTerm ?? '' }}" />
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>

          <div class="sort-dropdown">
            <label for="sort-select">Urutkan:</label
            ><select id="sort-select">
              <option value="all" {{ ($currentFilter ?? '') == 'all' ? 'selected' : '' }}>Semua Event</option>
              <option value="free" {{ ($currentFilter ?? '') == 'free' ? 'selected' : '' }}>Event Gratis</option>
              <option value="paid" {{ ($currentFilter ?? '') == 'paid' ? 'selected' : '' }}>Event Berbayar</option>
            </select>
          </div>
        </div>

        <section id="eventAktif" class="activity aktivitas-cards d-flex">
          <div class="container-fluid p-0">
            <div class="row">
              @foreach ( $events as $event )
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                  <article class="aktivitas-card ">
                    <a href="{{ route('order.eventDetail', $event->slug) }}" class="card-link"></a>
                    <img
                      src="{{ url('storage', $event->photo) }}"
                      alt="{{ $event->name }}"
                      class="aktivitas-image"
                    />
                    <div class="aktivitas-content">
                      <h2 class="aktivitas-title" title="event1">
                        <a href="{{ route('order.eventDetail', $event->slug) }}" class="card-link"
                          >{{$event->name}}</a
                        >
                      </h2>
                      <p class="aktivitas-date">{{ Date::parse($event->date)->format('j F Y') }}</p>
                      <p class="aktivitas-price">{{ Number::currency($event->price, 'IDR') }}</p>
                      <p class="aktivitas-organizer">Volunteer By TapakAsa</p>
                    </div>
                  </article>
                </div>
              @endforeach
              <div class='flex justify-end mt-6'>
                {{ $events->links('pagination::bootstrap-5') }}
              </div>
            </div>
          </div>



        </section>



        <section id="eventLalu" class="activity aktivitas-cards" style="display: none;">
            <article class="aktivitas-card">
            <img
              src="{{ asset('img/cariAktivitas.png') }}"
              alt="Event 1"
              class="aktivitas-image"
            />
            <div class="aktivitas-content">
              <h2 class="aktivitas-title" title="event1">
                Belajar Menanam Jamur Tiram Bersama Kelompok Petani Perempuan
              </h2>
              <p class="aktivitas-date">12 Juni 2025</p>
              <p class="aktivitas-price">Rp125.000</p>
              <p class="aktivitas-organizer">Volunteer By TapakAsa</p>
            </div>
        </section>
      </main>
    </div>

    <!-- footer section -->
    <x-footer></x-footer>

    <script>
      document.getElementById('sort-select').addEventListener('change', function() {
        const selectedFilter = this.value;
        const currentSearchTerm = document.querySelector('input[name="search"]').value;
        
        let url = '{{ route('landing.cariEvent') }}';
        let params = [];

        if (currentSearchTerm) {
            params.push('search=' + encodeURIComponent(currentSearchTerm));
        }
        if (selectedFilter) {
            params.push('filter=' + encodeURIComponent(selectedFilter));
        }

        if (params.length > 0) {
            url += '?' + params.join('&');
        }
        window.location.href = url;
      });

      // Anda bisa menghapus isi dari cariAktivitas.js jika semua logika ada di sini
      // atau gabungkan.
    </script>
    <script src="{{ asset('js/cariEvent.js') }}"></script>
    <script>

    </script>
  </body>
</html>
