<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesan Event</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
      rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="{{ asset('css/PesanEvent.css') }}" />
  </head>
  <body>
    <div class="header">
      <a href="{{ route('landing.cariEvent') }}" class="back-button">
        <img src="{{ asset('icons/GoBack.svg') }}" alt="Go Back" />
      </a>
      <!-- title -->
      <h2 class="section-title">Pesan Event</h2>
    </div>

    <!-- ticket section -->
    <main class="container main-content">
      <section class="left-column">
        <img
          src="{{ url('storage', $event->photo) }}"
          alt="Banner Event"
          class="event-banner"
        />
        <div class="tabs">
          <button class="tab active" onclick="showTab(event, 'deskripsi')">
            DESKRIPSI
          </button>
          {{-- <button class="tab" onclick="showTab(event, 'tiket')">TIKET</button> --}}
        </div>
        <div class="tab-content active" id="deskripsi">
          {{ $event->description }}
          <p><strong>Yuk daftar sekarang!</strong></p>
        </div>
      </section>

      <aside class="right-column">
        <div class="card event-info-card">
          <h2>{{ $event->name }}</h2>
          <p class="with-icon">
            <img src="{{ asset('icons/Schedule.svg') }}" alt="" /> {{ Date::parse($event->date)->format('j F Y') }}
          </p>
          <p class="with-icon">
            <img src="{{ asset('icons/Clock.svg') }}" alt="" /> {{ $event->time }}
          </p>
          <p class="with-icon">
            <img src="{{ asset('icons/PlaceMarker.svg') }}" alt="" /> {{ $event->location }}
          </p>
          <p class="text-info">
            {{ $event->ticket->name }}
          </p>
          <p class="aktivitas-organizer">Volunteer by TapakAsa</p>
        </div>
        <div class="card ticket-card">
          <div class="ticket-card-top">
            <img
              src="{{ asset('icons/TrainTicket.svg') }}"
              alt="Tiket"
              class="ticket-photo"
            />
            <h2 class="ticket-content">
              Silahkan pilih jumlah tiket yang Anda inginkan di bawah ini
            </h2>
          </div>
          <div class="ticket-price-row">
            <form method="POST" action="{{ route('order.handleDetailPemesanan', $event->slug) }}" autocomplete="off" class="buy-ticket-form">
              @csrf
                <div class="quantity-input">
                  <label for="quantity" class="form-label fw-bold">Jumlah Tiket</label>
                    <div class="input-group" style="max-width: 200px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseValue()">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" class="form-control text-center" id="quantity" name="quantity" value="1" min="1" max="10" required readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="increaseValue()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                  </div>
              <button type="submit" class="btn buy-ticket-btn">Beli Tiket</button>
            </form>
            <p><strong>
              {{-- {{  Number::currency($transaction->name, 'IDR') }} --}}
            </strong></p>
          </div>

      </aside>
    </main>

    <!-- footer section -->
    <x-footer></x-footer>

    <script>

      // toggle profile
      const profile = document.getElementById("profile");
      const dropdownMenu = document.getElementById("dropdownMenu");

      profile.addEventListener("click", () => {
        dropdownMenu.style.display =
          dropdownMenu.style.display === "flex" ? "none" : "flex";
      });

      // Klik di luar akan menutup dropdown
      window.addEventListener("click", function (e) {
        if (!profile.contains(e.target)) {
          dropdownMenu.style.display = "none";
        }
      });

      function showTab(evt, tabId) {
        const tabs = document.querySelectorAll(".tab");
        const contents = document.querySelectorAll(".tab-content");

        tabs.forEach((tab) => tab.classList.remove("active"));
        contents.forEach((content) => content.classList.remove("active"));

        document.getElementById(tabId).classList.add("active");
        evt.target.classList.add("active");
      }

      // toggle sidebar
      const menuToggle = document.getElementById("menu-toggle");
      const sidebar = document.getElementById("sidebar");
      const closeSidebar = document.getElementById("close-sidebar");

      menuToggle.addEventListener("click", () => {
        sidebar.classList.add("active");
      });

      closeSidebar.addEventListener("click", () => {
        sidebar.classList.remove("active");
      });

      // toggle ticket count
      function increaseValue() {
          const input = document.getElementById('quantity');
          const currentValue = parseInt(input.value) || 1;
          const maxValue = parseInt(input.max) || 10;
          
          if (currentValue < maxValue) {
              input.value = currentValue + 1;
              updateTotalPrice();
          }
      }

      function decreaseValue() {
          const input = document.getElementById('quantity');
          const currentValue = parseInt(input.value) || 1;
          const minValue = parseInt(input.min) || 1;
          
          if (currentValue > minValue) {
              input.value = currentValue - 1;
              updateTotalPrice();
          }
      }
    </script>
  </body>
</html>
