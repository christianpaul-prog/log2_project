<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Title --}}
    <title>@yield('content','Logistics 2')</title>

    <style>
        body {
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background: linear-gradient(180deg, #343a40, #212529);
            transition: all 0.3s;
            padding-top: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #495057;
            color: #fff;
        }

        .sidebar h2 {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        /* Logout stays at bottom */
        .button {
            margin-top: auto;
            margin-bottom: 15px;
        }

        /* Content */
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }

        /* Toggle button (hidden by default on desktop) */
        .toggle-btn {
            display: none;
            /* hidden by default */
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 200;
            background: #343a40;
            border: none;
            color: white;
            padding: 10px 14px;
            border-radius: 50%;
            font-size: 18px;
            transition: all 0.3s;
        }

        .toggle-btn:hover {
            background: #495057;
        }

        /* Mobile view */
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            .content {
                margin-left: 0;
            }

            /* 👇 force show toggle button on mobile */
            .toggle-btn {
                display: block !important;
            }
        }
    </style>
  </head>
  <body>
    {{-- Navbar --}}
    <div class="sidebar" id="sidebar">
        @include('layouts.sidebar')
        <button class="toggle-btn" id="toggleBtn">➤</button>
    </div>
    {{-- Main Content --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- Scripts --}}
    <script>
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggleBtn");

        function toggleSidebar() {
            sidebar.classList.toggle("active");

            // Change arrow direction
            if (sidebar.classList.contains("active")) {
                toggleBtn.innerHTML = "◀"; // Arrow left when open
            } else {
                toggleBtn.innerHTML = "➤"; // Arrow right when closed
            }
        }

        toggleBtn.addEventListener("click", toggleSidebar);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>