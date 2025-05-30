// TOGGLE PROFILE
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

// TOGGLE SIDEBAR
const menuToggle = document.getElementById("menu-toggle");
const sidebar = document.getElementById("sidebar");
const closeSidebar = document.getElementById("close-sidebar");

menuToggle.addEventListener("click", () => {
  sidebar.classList.add("active");
});

closeSidebar.addEventListener("click", () => {
  sidebar.classList.remove("active");
});

// toggle dropdown sidebar
document
  .getElementById("sidebarProfileToggle")
  .addEventListener("click", function () {
    const profileItem = this.parentElement;
    profileItem.classList.toggle("active");
  });
