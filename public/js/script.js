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

// navbar scroll effect
window.addEventListener("scroll", function () {
  const header = document.querySelector("header");
  if (window.scrollY > 50) {
    header.style.background = "#ffffff";
    header.style.background = "rgba(255, 255, 255, 0.95)";
  } else {
    header.style.background = "rgba(255, 255, 255, 0)";
    header.style.boxShadow = "none";
  }
});

// kasih warna ni logo dan menu nav
window.addEventListener("scroll", function () {
  const header = document.querySelector("header");
  const logo = document.querySelector(".logo");
  const navLinks = document.querySelectorAll(".nav-menu li a");

  if (window.scrollY > 50) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});

// navbar active
const currentPath = window.location.pathname;
const fileName = currentPath
  .substring(currentPath.lastIndexOf("/") + 1)
  .split("?")[0];

document.querySelectorAll(".nav-menu a").forEach((link) => {
  const href = link.getAttribute("href").split("?")[0]; // abaikan query string
  if (href === fileName) {
    link.classList.add("active");
  }
});

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