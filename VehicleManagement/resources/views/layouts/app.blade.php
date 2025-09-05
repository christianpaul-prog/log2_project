<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>


<body>
    <div class="wrapper">
        @include('partials.sidebar')

        <div class="main">
            @include('partials.header')
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script>
        const sidebarToggle = document.querySelector("#sidebar-toggle");
        sidebarToggle.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed");
            document.querySelector(".main").classList.toggle("expanded");
        });
        document.addEventListener("DOMContentLoaded", function() {
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
    </script>
</body>

</html>
