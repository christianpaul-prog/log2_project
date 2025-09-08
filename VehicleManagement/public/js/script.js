  const sidebarToggle = document.querySelector("#sidebar-toggle");
        sidebarToggle.addEventListener("click",function(){
            document.querySelector("#sidebar").classList.toggle("collapsed");
              document.querySelector(".main").classList.toggle("expanded");
        });
document.addEventListener("DOMContentLoaded", function () {
  const modeToggle = document.querySelector(".mode-toggle");
  const main = document.querySelector(".main");
  const sidebar = document.querySelector("#sidebar"); // 👈 idagdag mo ito

  if (localStorage.getItem("dark-mode") === "enabled") {
    main.classList.add("dark");
    sidebar.classList.add("dark"); // 👈 apply din sa sidebar
  }

  modeToggle.addEventListener("click", () => {
    main.classList.toggle("dark");
    sidebar.classList.toggle("dark"); // 👈 toggle din sa sidebar

    if (main.classList.contains("dark")) {
      localStorage.setItem("dark-mode", "enabled");
    } else {
      localStorage.setItem("dark-mode", "disabled");
    }
  });
});
