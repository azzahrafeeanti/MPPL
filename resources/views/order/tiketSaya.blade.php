<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tiket Saya</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/tiketSaya.css') }}" />
</head>

<body>
    <div class="container">
        <a href="{{ route('landing.index') }}" class="back-button">
            <img src="{{ asset('icons/GoBack.svg') }}" alt="Go Back" />
        </a>

        <div class="tab-content" id="riwayat">
            <h3>Riwayat Pembelian Anda</h3>
            @if($transactions->isEmpty())
                <p>Anda belum memiliki riwayat pembelian tiket.</p>
            @else
                {{-- Lakukan loop untuk setiap transaksi --}}
              @foreach($transactions as $transaction)
                <div class="ticket-card">
                    <div class="text-wrapper">
                        <p class="ticket-title">{{ $transaction->event->name }}</p>
                        <p class="ticket-time">
                            <img src="{{ asset('icons/Clockblue.svg') }}" alt="jam" /> Berakhir {{ Date::parse($transaction->event->date)->format('j F Y') }} {{ Date::parse($transaction->event->time)->format('H:i') }} WIB
                        </p>
                        <p class="ticket-price">Rp235.000</p>
                    </div>
                </div>
              @endforeach
            @endif
        </div>
    </div>
</body>

</html>
