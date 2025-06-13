document.addEventListener('DOMContentLoaded', function() {
const promoCodeInput = document.getElementById('promo-code-input');
const applyPromoBtn = document.getElementById('apply-promo-btn');
const promoInfoText = document.getElementById('promo-info-text');
const subTotalDisplay = document.getElementById('sub-total-display');
const discountDisplay = document.getElementById('discount-display');
const grandTotalDisplay = document.getElementById('grand-total-display');

// Fungsi format mata uang
function formatRupiah(number) {
return 'Rp' + parseFloat(number).toLocaleString('id-ID');
}

// Fungsi untuk mengirim permintaan AJAX saat tombol 'Terapkan' diklik
applyPromoBtn.addEventListener('click', async () => {
const promoCode = promoCodeInput.value.trim();
const slug = "{{ $event->slug }}";
const transactionId = "{{ $transaction->id }}";
const csrfToken = document.querySelector('meta[name="csrf-token"]') ?
document.querySelector('meta[name="csrf-token"]').content : '@csrf'; // Fallback jika tidak ada meta tag

if (!promoCode) {
promoInfoText.textContent = 'Masukkan kode promo terlebih dahulu.';
promoInfoText.className = 'promo-message error';
return;
}

try {
const response = await fetch(`/order/${slug}/apply-promo/${transactionId}`, {
method: 'POST',
headers: {
'Content-Type': 'application/json',
'Accept': 'application/json',
'X-CSRF-TOKEN': '{{ csrf_token() }}' // Mengambil CSRF token dari Blade
},
body: JSON.stringify({ promo_code: promoCode })
});

const data = await response.json();

if (response.ok) {
subTotalDisplay.textContent = formatRupiah(data.sub_total_amount);
discountDisplay.textContent = formatRupiah(data.discount_amount);
grandTotalDisplay.textContent = formatRupiah(data.grand_total_amount);
promoInfoText.textContent = data.message;
promoInfoText.className = 'promo-message success';
} else {
promoInfoText.textContent = data.message || 'Terjadi kesalahan saat menerapkan promo.';
promoInfoText.className = 'promo-message error';
// Reset diskon dan grand total jika promo gagal
discountDisplay.textContent = formatRupiah(data.discount_amount);
grandTotalDisplay.textContent = formatRupiah(data.grand_total_amount);
}
} catch (error) {
console.error('Error applying promo:', error);
promoInfoText.textContent = 'Tidak dapat menghubungi server. Coba lagi.';
promoInfoText.className = 'promo-message error';
}
});
});
function toggleDropdown(button) {
const card = button.closest(".payment-card");
card.classList.toggle("open");
const options = card.querySelector(".payment-options");
if (options.style.display === "flex") {
options.style.display = "none";
} else {
options.style.display = "flex";
}
}

// Countdown Timer
let countdownEl = document.getElementById("countdown");
let timeLeft = 15 * 60; // 15 menit dalam detik

function updateCountdown() {
let minutes = Math.floor(timeLeft / 60);
let seconds = timeLeft % 60;

// Format waktu 2 digit
minutes = minutes < 10 ? "0" + minutes : minutes; seconds=seconds < 10 ? "0" + seconds : seconds;
    countdownEl.textContent=`${minutes}:${seconds}`; if (timeLeft> 0) {
    timeLeft--;
    } else {
    clearInterval(timer);
    countdownEl.textContent = "00:00";
    // Optional: aksi kalau waktu habis
    alert("Waktu pembayaran telah habis!");
    }
    }

    // Mulai countdown
    updateCountdown();
    let timer = setInterval(updateCountdown, 1000);

    // PEMBYARAN
    const paymentInfo = document.getElementById("payment-info");
    // Daftar metode & nomor/QR
    const paymentDetails = {
    gopay: { img: "/img/GoPayLogo.jpg", nomor: "0823-5689-9654" },
    shopeepay: { img: "/img/shopeepay.jpg", nomor: "0812-3456-7890" },
    dana: { img: "/img/dana.png", nomor: "0813-9876-5432" },
    linkaja: { img: "/img/link.jpg", nomor: "0811-2233-4455" },
    ovo: { img: "/img/ovo.jpg", nomor: "0819-3344-1122" },
    bri: { img: "/img/bri.png", nomor: "1234567890" },
    bni: { img: "/img/bni.png", nomor: "2345678901" },
    mandiri: { img: "/img/mandiri.jpg", nomor: "3456789012" },
    bsi: { img: "/img/bsi.png", nomor: "4567890123" },
    cimb: { img: "/img/cimb.jpg", nomor: "5678901234" },
    qris: { img: "/img/qris.png", nomor: null }, // QRIS berupa gambar saja
    };

    // Fungsi saat klik metode
    function showPaymentInfo(method) {
    const data = paymentDetails[method];
    if (!data) return;

    let html = `
    <div class="payment-method-box">
        <img src="${data.img}" alt="${method}" />
        `;

        // Tambahkan tombol "Lihat QRIS" hanya jika metode qris
        if (method === "qris") {
        html += `
        <button class="btn-qris" onclick="openQrisPopup()">Lihat QRIS</button>
        `;
        } else if (data.nomor) {
        html += `
        <span>${data.nomor}</span>
        `;
        }

        html += `
    </div>`;

    html += `
    <div class="upload-proof">
        <div class="upload-row">
            <label id="label-upload" for="proof-upload">Bukti Pembayaran</label>
            <div class="custom-file">
                <button type="button" onclick="document.getElementById('proof-upload').click()">Choose File</button>
                <span id="file-name"></span>
            </div>
        </div>
        <input type="file" id="proof-upload" name="proof" style="display: none;" onchange="updateFileName(this)" />
    </div>
    `;

    if (method === "qris") {
    html += `
    <!-- Modal QRIS -->
    <div class="modal-qris" id="qrisModal">
        <div class="modal-content">
            <span class="close" onclick="closeQrisPopup()">&times;</span>
            <img src="/img/QRIA.png" alt="QRIS" />
        </div>
    </div>
    `;
    }

    paymentInfo.innerHTML = html;
    paymentInfo.classList.remove("hidden");
    }

    function updateFileName(input) {
    const fileName = input.files[0]?.name || "Bukti Pembayaran";
    document.getElementById("label-upload").textContent = fileName;
    }

    function openQrisPopup() {
    document.getElementById("qrisModal").style.display = "block";
    }

    function closeQrisPopup() {
    document.getElementById("qrisModal").style.display = "none";
    }

    // payment card
    function toggleDropdown(button) {
    const options = button.nextElementSibling;
    options.classList.toggle("hidden");

    // Putar ikon panah
    const arrow = button.querySelector(".arrow");
    arrow.textContent = options.classList.contains("hidden") ? "⌄" : "⌃";
    }
