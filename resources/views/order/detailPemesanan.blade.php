{{-- {{ dd($event, $transaction) }} --}}
{{-- {{ dd($transaction->id) }} --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Pemesanan Tiket</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
        rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/detailPemesanan.css') }}" />
</head>

<body>
    <div class="container">
        <!-- header -->
        <a href="{{ route('order.eventDetail', ['slug' => $event->slug]) }}" class="back-button">
            <img src="{{ asset('icons/GoBack.svg') }}" alt="Go Back" />
        </a>
        <h2 class="section-title main-title">Detail Pemesanan</h2>

        <main class="main-content">
            <form action="{{ route('order.updatePersonalDetails', ['slug' => $event->slug, 'transaction_id' => $transaction->id]) }}" method="POST" id="form-pemesanan" enctype="multipart/form-data" novalidate>
            @csrf
                <section class="left-column">
                    <!-- Detail Pemesanan -->
                    <div class="card detail-pemesanan">
                        <div class="event-info">
                            <img src="{{ url('storage', $event->photo) }}" alt="Event Image" />
                            <div class="event-text">
                                <h2>{{ $event->name }}</h2>
                                <p class="with-icon">
                                    <img src="{{ asset('icons/Schedule.svg') }}" alt="" /> {{$event->date}}
                                </p>
                                <p class="with-icon">
                                    <img src="{{ asset('icons/Clock.svg') }}" alt="" /> {{ $event->time }}
                                </p>
                                <p class="with-icon">
                                    <img src="{{ asset('icons/PlaceMarker.svg') }}" alt="" /> {{ $event->location}}
                                </p>
                            </div>
                        </div>
                        <table class="ticket-summary">
                            <thead>
                                <tr>
                                    <th>Jenis Tiket</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="ticket-info">
                                            <img src="{{ asset('icons/TrainTicket.svg') }}" alt="icon"
                                                class="ticket-icon" />
                                            <span class="ticket-name">{{ $event->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $event->price }}</td>
                                    <td>x{{ $transaction->quantity }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Form Detail Pemesan -->
                    <div class="form-pemesanan">
                        <h2 class="section-title form-title">Detail Pemesan</h2>
                        <div class="ticket-header">
                            <span class="ticket-label">Tiket 1: {{ $event->name }}</span>
                        </div>

                        <div class="card form-pemesan" novalidate>
                            <p class="info-text">
                                <img src="{{ asset('icons/PenerimaInformasi.svg') }}" alt="" /> Penerima informasi
                                transaksi
                            </p>

                            <!-- Display validation errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul style="margin: 0; padding-left: 20px;">
                                        @foreach ($errors->all() as $error)
                                            <li style="color: red; margin-bottom: 5px;">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <label for="name">Nama Lengkap <span class="required">*</span></label>
                            <label for="" class="sub-title">Gunakan nama yang tertera di KTP/Paspor</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $transaction->name) }}" required />
                            @error('name') <div class="text-danger" data-field="name">{{ $message }}</div> @enderror

                            <label for="email">Email <span class="required">*</span></label>
                            <label for="" class="sub-title">E-tiket akan dikirim ke email kamu</>
                                <input type="email" id="email" name="email" value="{{ old('email', $transaction->email) }}" required />
                                @error('email') <div class="text-danger" data-field="email">{{ $message }}</div> @enderror

                                <label for="tanggalLahir">Tanggal Lahir <span class="required">*</span></label>
                                <input type="date" id="date" name="date" value="{{ old('date', $transaction->date) }}" required />
                                

                                <label for="gender">Jenis Kelamin <span class="required">*</span></label>
                                <select id="gender" name="gender" required>
                                    <option value="" disabled {{ old('gender', $transaction->gender) == '' ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                    <option value="laki-laki" {{ old('gender', $transaction->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="perempuan" {{ old('gender', $transaction->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender') <div class="text-danger" data-field="gender">{{ $message }}</div> @enderror


                                <label for="NIK">NIK <span class="required">*</span></label>
                                <label for="" class="sub-title">Peserta akan mendapatkan perlindungan
                                    asuransi.</label>
                                <input type="text" id="NIK" name="NIK" value="{{ old('NIK', $transaction->NIK) }}" required />
                                @error('NIK') <div class="text-danger" data-field="NIK">{{ $message }}</div> @enderror

                                <label for="akunSosmed">Akun Media Sosial <span class="required">*</span></label>
                                <label for="" class="sub-title">Instagram atau Tiktok</label>
                                <input type="text" id="akunSosmed" name="akunSosmed" value="{{ old('akunSosmed', $transaction->social_media_account ?? '') }}" required />
                                @error('akunSosmed') <div class="text-danger" data-field="akunSosmed">{{ $message }}</div> @enderror

                                <fieldset class="radio-group">
                                    <legend>
                                        Saya Bersedia Untuk Membaca dan Menaati Handbook?
                                        <span class="required">*</span>
                                    </legend>
                                    <label><input type="radio" name="bersediaHandbook" value="YA" {{ old('bersediaHandbook', ($transaction->agree_handbook ?? false) ? 'YA' : '') == 'YA' ? 'checked' : '' }} required /> YA</label>
                                    <label><input type="radio" name="bersediaHandbook" value="TIDAK" {{ old('bersediaHandbook', ($transaction->agree_handbook ?? false) ? '' : 'TIDAK') == 'TIDAK' ? 'checked' : '' }} /> TIDAK</label>
                                </fieldset>
                        </div>
                    </div>

                    <div class="form-note">
                        <img src="{{ asset('icons/Important.svg') }}" alt="important" />
                        <span>Pastikan datamu sudah benar.</span>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="payment-section">
                        <h2>Metode Pembayaran</h2>

                        <div class="payment-card">
                            <button class="payment-header" onclick="toggleDropdown(this)">
                                <span>E-Wallet</span>
                                <span class="arrow">⌄</span>
                            </button>
                            <div class="payment-options ewallet">
                                <img src="{{ asset('img/GoPayLogo.jpg') }}" alt="gopay" onclick="showPaymentInfo('gopay')" />
                                <img src="{{ asset('img/shopeepay.jpg') }}" alt="ShopeePay" onclick="showPaymentInfo('shopeepay')" />
                                <img src="{{ asset('img/dana.png') }}" alt="Dana" onclick="showPaymentInfo('dana')" />
                                <img src="{{ asset('img/link.jpg') }}" alt="LinkAja" onclick="showPaymentInfo('linkaja')" />
                                <img src="{{ asset('img/ovo.jpg') }}" alt="OVO" onclick="showPaymentInfo('ovo')" />
                            </div>
                        </div>

                        <div class="payment-card">
                            <button class="payment-header" onclick="toggleDropdown(this)">
                                <span>Virtual Account</span>
                                <span class="arrow">⌄</span>
                            </button>
                            <div class="payment-options">
                                <img src="{{ asset('img/bri.png') }}" alt="BRI" onclick="showPaymentInfo('bri')" />
                                <img src="{{ asset('img/bni.png') }}" alt="BNI" onclick="showPaymentInfo('bni')" />
                                <img src="{{ asset('img/mandiri.jpg') }}" alt="Mandiri" onclick="showPaymentInfo('mandiri')" />
                                <img src="{{ asset('img/bsi.png') }}" alt="BSI" onclick="showPaymentInfo('bsi')" />
                                <img src="{{ asset('img/cimb.jpg') }}" alt="CIMB" onclick="showPaymentInfo('cimb')" />
                            </div>
                        </div>

                        <div class="payment-card">
                            <button class="payment-header" onclick="toggleDropdown(this)">
                                <span>QR</span>
                                <span class="arrow">⌄</span>
                            </button>
                            <div class="payment-options">
                                <img src="{{ asset('img/qris.png') }}" alt="qris" onclick="showPaymentInfo('qris')" />
                            </div>
                        </div>
                    </div>
                </section>

                <aside class="right-column">
                    <div class="timer">
                        <span class="time" id="countdown">15:00</span>
                        <span class="message">Segera selesaikan pesananmu</span>
                    </div>

                    <div class="card payment-summary">

                        <!-- detail payment-->
                        <div id="payment-info" class="payment-info hidden"></div>

                        <div class="price-details">
                            <h3>Detail Harga</h3>
                            <ul>
                                <li><span>Total Harga Tiket</span><span>{{ $transaction->sub_total_amount }}</span></li>
                                <li><span>Biaya Admin</span><span>Rp0</span></li>
                            </ul>
                            <div class="total-bayar">
                                <span>Total Bayar</span>
                                <span>{{ $transaction->grand_total_amount }}</span>
                            </div>
                        </div>

                        <div class="agreement-form" novalidate>
                            <label>
                                <input type="checkbox" required />
                                Saya setuju dengan <a href="#">Syarat dan Ketentuan</a> yang
                                berlaku di TapakAsa®
                            </label>
                            <label>
                                <input type="checkbox" required />
                                Saya setuju dengan <a href="#">Pemrosesan Data Pribadi</a> yang
                                berlaku di TapakAsa®
                            </label>
                            <p class="warning-text">
                                Syarat & Ketentuan dan Pemrosesan Data Pribadi harus disetujui!
                            </p>
                            <button type="submit" class="btn-pay">Beli Tiket</button>
                        </div>
                    </div>
                </aside>
            </form>
        </main>
    </div>

    <!-- footer section -->
    <x-footer></x-footer>

    <script>
        window.appData = {
            eventSlug: "{{ $event->slug }}",
            transactionId: "{{ $transaction->id }}",
        };
    </script>

    <script src="{{ asset('js/detailPemesanan.js') }}"></script>
</body>

</html>
