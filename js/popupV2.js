// Load file popup.html
document.addEventListener("DOMContentLoaded", async () => {
  const container = document.getElementById("popupContainer");
  const response = await fetch("components/popupV2.html");
  const html = await response.text();
  container.innerHTML = html;
});

// Buka popup
function openPopup(id) {
  document.getElementById(id).style.display = "flex";
}

// Tutup popup
function closePopup(id) {
  document.getElementById(id).style.display = "none";
}

// Pindah ke popup selanjutnya
function nextPopup(nextId) {
  const popups = document.querySelectorAll(".popup-overlay");
  popups.forEach((p) => (p.style.display = "none"));
  document.getElementById(nextId).style.display = "flex";
}

// popup tab tanggal dan waktu
function switchTab(tabId) {
  const tabs = document.querySelectorAll(".tab-section");
  const buttons = document.querySelectorAll(".tab-button");

  tabs.forEach((tab) => {
    tab.style.display = "none";
    tab.classList.remove("active");
  });
  buttons.forEach((btn) => btn.classList.remove("active"));

  document.getElementById(tabId).style.display = "block";
  document.getElementById(tabId).classList.add("active");
  document.querySelector(`[data-tab="${tabId}"]`).classList.add("active");
}

// popup lokasi
function toggleEventLocationMode() {
  const isOnline = document.getElementById("toggleOnlineEvent").checked;
  document.getElementById("offlineFields").style.display = isOnline
    ? "none"
    : "block";
  document.getElementById("onlineFields").style.display = isOnline
    ? "block"
    : "none";
  document.getElementById("eventModeTitle").innerText = isOnline
    ? "Online"
    : "Offline";
}
