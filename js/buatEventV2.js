function showTab(tabName) {
  // Sembunyikan semua tab
  const allTabs = document.querySelectorAll(".tab-content");
  allTabs.forEach((tab) => {
    tab.style.display = "none";
  });

  // Hapus class 'active' dari semua tab header
  const allHeaders = document.querySelectorAll(".tab-header .tab");
  allHeaders.forEach((header) => {
    header.classList.remove("active");
  });

  // Tampilkan tab yang dipilih
  document.getElementById(tabName).style.display = "block";

  // Tambahkan class 'active' ke tab header yang diklik
  const clickedTab = Array.from(allHeaders).find((header) =>
    header.textContent
      .trim()
      .toUpperCase()
      .includes(
        tabName
          .replace(/([A-Z])/g, " $1")
          .trim()
          .toUpperCase()
      )
  );
  if (clickedTab) {
    clickedTab.classList.add("active");
  }
}

// Optional: tampilkan tab pertama saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
  showTab("kategoriTiket");
});
