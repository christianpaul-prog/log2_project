<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    
       
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    ::after,
    ::before {
        box-sizing: border-box;
    }

   body {
    
    font-family: 'Poppins', sans-serif;
    font-size: 0.875rem;
    opacity: 1;
    overflow-y: scroll;
    margin: 0;
    
}

a {
    cursor: pointer;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
}

    li {
        list-style: none;
    }

    .wrapper {
        
        align-items: stretch;
        display: flex;
        width: 100%;
        
     

    }
   
    #sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  max-width: 264px;
  min-width: 264px;
  background: #0b0f19;
  transition: all 0.35s ease-in-out;
  overflow-y: auto; 
  z-index: 1030;
}
     
#sidebar::-webkit-scrollbar,
.main main::-webkit-scrollbar {
  width: 5px;
}

#sidebar::-webkit-scrollbar-track,
.main main::-webkit-scrollbar-track {
  background: #0b0f19;
}

#sidebar::-webkit-scrollbar-thumb,
.main main::-webkit-scrollbar-thumb {
  background-color: #3b7ddd;
  border-radius: 4px;
}


.main {
  margin-left: 264px; 
  flex: 1;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background: white;
  transition: all 0.35s ease-in-out;
  overflow: hidden;
}


.main nav.navbar {
  position: fixed;
  top: 0;
  left: 264px;
  right: 0;
  height: 56px;
  background: #fff;
  transition: all 0.35s ease-in-out;
  z-index: 1020;
}


.main main {
  flex: 1;
  margin-top: 10px;
  padding: 20px;
  overflow-y: auto;
 
}
    .main.dark{
         background: #0b0f19;
    }
    .main.dark nav.navbar{
           background: #0b0f19;
    }
    .sidebar-logo {
        padding: 1.15rem;
        font-size: 1.15rem;
        font-weight: 600;
    }

    .sidebar-logo a {
        color: #fff;
        font-size: 1.15rem;
        font-weight: 600;
    }

    .sidebar-nav {
        flex-grow: 1;
        list-style: none;
        margin-bottom: 20px;
        padding-left: 0;
        margin-left: 0;
    }

    .sidebar-header {
        color: #fff;
        font-size: .75rem;
        padding: 1.5rem 1.5rem .375rem;
    }

    a.sidebar-link {
        padding: .625rem 1.625rem;
        color: #fff;
        position: relative;
        display: block;
        font-size: 0.875rem;
        margin-bottom:5px;

    }
a.sidebar-link:hover{
    background-color: rgba(255,255,255,.075);
    border-left: 3px solid #3b7ddd;
}
    .sidebar-link[data-bs-toggle="collapse"]::after {
        border: solid;
        border-width: 0 .075rem .075rem 0;
        content: "";
        display: inline-block;
        padding: 2px;
        position: absolute;
        right: 1.5rem;
        top: 1.4rem;
        transform: rotate(-135deg);
        transition: all .2s ease-out;
    }

    .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
        transform: rotate(45deg);
        transition: all .2s ease;
    }
    .avatar{
        height: 46px;
        width: 40px;

    }
    .navbar-expand .navbar-nav{
        margin-left: auto;
    
    }
  
    /**
    .content{
        flex: 1;
        max-width: 100vw;
        width: 100vw;
    }
    @media (min-width:768) 
           {
        .content{
            max-width: auto;
            width: auto;
        }
    }
    .card{
        box-shadow: 0 0 .875rem 0 rgba(34, 46, 60, .05);
        margin-bottom: 24px;
    }
    .illustration{
        background-color: var(--bs-primary-bg-subtle);
            color: ;
        **/
        #sidebar.collapsed{
            margin-left: -264px;
        }
        #sidebar.collapsed ~ .main {
  margin-left: 0;
}
#sidebar.collapsed ~ .main nav.navbar {
  left: 0;
}
        .mode {
  display: flex;
  align-items: center;
  margin-left: 1rem;
}

.mode a {
  color: inherit;
  display: flex;
  align-items: center;
  gap: .5rem;
}

.mode-toggle {
  margin-left: .5rem;
  width: 40px;
  height: 20px;
  background: #ccc;
  border-radius: 20px;
  position: relative;
  cursor: pointer;
  transition: background 0.3s ease;
}

/* Bilog sa loob ng switch */
.mode-toggle::before {
  content: "";
  position: absolute;
  left: 2px;
  top: 50%;
  transform: translateY(-50%);
  height: 16px;
  width: 16px;
  background: #fff;
  border-radius: 50%;
  transition: left 0.3s ease;
}

/* kapag dark mode */
.main.dark .mode-toggle {
  background: #333;
}

.main.dark .mode-toggle::before {
  left: 22px;
}
    </style>

    <body>
        <div class="wrapper">
        @include('partials.sidebar')

            <div class="main">
            @include('partials.header')
    <main >
            @yield('content')
        </main>
    </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
        <script>
        const sidebarToggle = document.querySelector("#sidebar-toggle");
        sidebarToggle.addEventListener("click",function(){
            document.querySelector("#sidebar").classList.toggle("collapsed");
              document.querySelector(".main").classList.toggle("expanded");
        });
const modeToggle = document.querySelector(".mode-toggle");
  const main = document.querySelector(".main");
  


  if (localStorage.getItem("dark-mode") === "enabled") {
    main.classList.add("dark");
  }

  modeToggle.addEventListener("click", () => {
    main.classList.toggle("dark");

    if (main.classList.contains("dark")) {
      localStorage.setItem("dark-mode", "enabled");
    } else {
      localStorage.setItem("dark-mode", "disabled");
    }
  });


        </script>
    </body>

    </html>