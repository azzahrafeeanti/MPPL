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
  minutes = minutes < 10 ? "0" + minutes : minutes;
  seconds = seconds < 10 ? "0" + seconds : seconds;

  countdownEl.textContent = `${minutes}:${seconds}`;

  if (timeLeft > 0) {
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
  gopay: { img: "assets/img/GoPayLogo.jpg", nomor: "0823-5689-9654" },
  shopeepay: { img: "assets/img/shopeepay.jpg", nomor: "0812-3456-7890" },
  dana: { img: "assets/img/dana.png", nomor: "0813-9876-5432" },
  linkaja: { img: "assets/img/link.jpg", nomor: "0811-2233-4455" },
  ovo: { img: "assets/img/ovo.jpg", nomor: "0819-3344-1122" },
  bri: { img: "assets/img/bri.png", nomor: "1234567890" },
  bni: { img: "assets/img/bni.png", nomor: "2345678901" },
  mandiri: { img: "assets/img/mandiri.jpg", nomor: "3456789012" },
  bsi: { img: "assets/img/bsi.png", nomor: "4567890123" },
  cimb: { img: "assets/img/cimb.jpg", nomor: "5678901234" },
  qris: { img: "assets/img/qris.png", nomor: null }, // QRIS berupa gambar saja
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

  html += `</div>`;

  html += `
          <div class="upload-proof">
            <div class="upload-row">
              <label id="label-upload" for="proof-upload">Bukti Pembayaran</label>
              <div class="custom-file">
                <button type="button" onclick="document.getElementById('proof-upload').click()">Choose File</button>
                <span id="file-name"></span>
              </div>
            </div>
            <input type="file" id="proof-upload" style="display: none;" onchange="updateFileName(this)" />
          </div>
        `;

  if (method === "qris") {
    html += `
            <!-- Modal QRIS -->
            <div class="modal-qris" id="qrisModal">
              <div class="modal-content">
                <span class="close" onclick="closeQrisPopup()">&times;</span>
                <img src="assets/img/QRIA.png" alt="QRIS" />
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

// BELI TIKET POPUP
const modal = document.getElementById("successModal");

document.querySelector(".btn-pay").addEventListener("click", function (e) {
  e.preventDefault(); // stop form submit

  const checkboxes = document.querySelectorAll(
    ".agreement-form input[type='checkbox']"
  );
  const allChecked = Array.from(checkboxes).every((cb) => cb.checked);

  if (!allChecked) {
    document.querySelector(".warning-text").style.display = "block";
    return;
  }

  document.querySelector(".warning-text").style.display = "none";

  // Generate booking ID random
  const id = "TK" + Math.floor(100000 + Math.random() * 900000);
  document.getElementById("bookingId").textContent = id;

  modal.style.display = "block";
});

function closeModal() {
  modal.style.display = "none";
}

window.onclick = function (event) {
  if (event.target === modal) {
    closeModal();
  }
};

// popup link url
const shareModal = document.getElementById("shareModal");

document.querySelector(".btn-share").addEventListener("click", function () {
  const bookingId = document.getElementById("bookingId").textContent;
  const link = `https://tapakasa.com/event/${bookingId}`;
  document.getElementById("shareLink").value = link;
  shareModal.style.display = "block";
});

function closeShareModal() {
  shareModal.style.display = "none";
}

function copyToClipboard() {
  const linkInput = document.getElementById("shareLink");
  linkInput.select();
  linkInput.setSelectionRange(0, 99999); // for mobile
  navigator.clipboard.writeText(linkInput.value).then(() => {
    alert("Link berhasil disalin!");
  });
}

window.addEventListener("click", function (event) {
  if (event.target === shareModal) {
    closeShareModal();
  }
});

document.querySelector(".btn-share").addEventListener("click", function () {
  const bookingId = document.getElementById("bookingId").textContent;
  const link = `https://tapakasa.com/event/${bookingId}`;
  document.getElementById("shareLink").value = link;

  // Sembunyikan modal sukses
  document.getElementById("successModal").style.display = "none";

  // Tampilkan modal share
  document.getElementById("shareModal").style.display = "block";
});
