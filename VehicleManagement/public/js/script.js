document.addEventListener("DOMContentLoaded", function () {
  const modeToggle = document.querySelector(".mode-toggle");
  const main = document.querySelector(".main");
  const sidebar = document.querySelector("#sidebar");
  const sidebarToggle = document.querySelector("#sidebar-toggle");

  // ✅ Restore dark mode state
  if (localStorage.getItem("dark-mode") === "enabled") {
    main.classList.add("dark");
    sidebar.classList.add("dark");
  }

  // ✅ Restore sidebar collapsed state
  if (localStorage.getItem("sidebar-collapsed") === "true") {
    sidebar.classList.add("collapsed");
    main.classList.add("expanded");
  }

  // Toggle dark mode
  modeToggle.addEventListener("click", () => {
    main.classList.toggle("dark");
    sidebar.classList.toggle("dark");

    if (main.classList.contains("dark")) {
      localStorage.setItem("dark-mode", "enabled");
    } else {
      localStorage.setItem("dark-mode", "disabled");
    }
  });

  // Toggle sidebar + save state
  sidebarToggle.addEventListener("click", function () {
    sidebar.classList.toggle("collapsed");
    main.classList.toggle("expanded");

    localStorage.setItem(
      "sidebar-collapsed",
      sidebar.classList.contains("collapsed")
    );
  });
});

// ⏰ Clock
setInterval(() => {
  document.getElementById("clock").innerText = new Date().toLocaleString();
}, 1000);
