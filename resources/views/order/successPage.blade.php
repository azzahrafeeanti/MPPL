{{-- {{ dd($event, $transaction) }} --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success Page</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Sriracha&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/success.css') }}" />
</head>
<body>

    <div id="successModal" class="modal-success">
        <div class="modal-content">
            <a href="{{ route('landing.index') }}">
                <span class="close" onclick="closeModal()">&times;</span>

            </a>
            <img src="{{ asset('img/Approval.png') }}" alt="Berhasil" style="width: 80px; margin-bottom: 20px;" />
            <h3 style="margin: 0;">Selamat!</h3>
            <p style="font-weight: 600; margin: 8px 0 0;">Anda Berhasil Membeli Tiket</p>
            <p style="margin-top: 12px;">Booking Id : <strong>{{ $transaction->booking_trx_id }}</strong></p>
            <a href="{{ route('order.tiketSaya') }}" class="btn-history">Riwayat Pembelian</a>
        </div>
    </div>
    
</body>
</html>