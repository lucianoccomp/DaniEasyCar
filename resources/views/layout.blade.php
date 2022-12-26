<!DOCTYPEhtml>
<html>
<head>
    <title> EasyCAR - Sistema de Locação de Veículos </title>

    <!-- CSS --> 
    <link href = "{{url('css/bootstrap.min.css')}}" rel = "stylesheet" >    
    <link href = "{{url('css/table-responsive.css')}}" rel = "stylesheet" >
    <link href = "{{url('css/bootstrap-datepicker.min.css')}}" rel = "stylesheet" >
    <link href = "{{url('css/blue/style.css')}}" rel = "stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- JS --> 
    <script src="{{ url('js/jquery-3.6.1.js')}}"></script>
    <script src="{{ url('js/jquery.tablesorter.min.js')}}"></script>
    <script src="{{ url('js/jquery.maskMoney.min.js')}}"></script>
     <script src="{{ url('js/bootstrap-datepicker.js')}}"></script>    
    <script src="{{ url('js/jquery.mask.min.js')}}"></script>

    <link rel="shortcut icon" href="{{ asset('storage/fotos/logo-ico.ico') }}">
    
    <!-- <link href="{{ url('css/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">-->
   
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

    body {
        background-color: rgba(236, 237, 244,0.4);
    }

    /* change the brand and text color */
    .navbar .navbar-brand,
    .navbar .navbar-text {
        color: white;        
       
    }
    /* change the link color */
    .navbar-nav .nav-item .nav-link {
        color: white;
        margin:5px;
        height: 42px;
    }
    /* change the color of active or hovered links */
    .navbar-nav .nav-item.active .nav-link,
    .navbar-nav .nav-item:hover .nav-link {
        background: white;
        color:black;
    }

    .colNum{
        width:100px;
        text-align:center;        
    }

    .colNunCenter{
        text-align:center;
    }

    .colNunRigth{
        text-align:right;
    }

    .noLink{
        color:black;
        text-decoration: none;
    }

    .color1{
        background-color:#414c8c;
    }

    .nome{
        text-align:left;        
    }

    .nome-size{
        font-size: 1.1em;        
    }

    .text-small{
        font-size: .95em;
    }

    @media (min-width: 600px) {
        .ocultar:first-child {
            display: none;
        }
    }

    @media (max-width: 600px) {
        .ocultar {
            display: block;
        }
    }

    .border-top-blue{
        border-top-style: solid;
        border-top-color: blue;
        border-top-width: 2px;
    }

    .border-top-yellow{
        border-top-style: solid;
        border-top-color: yellow;
        border-top-width: 2px;
    }

    .border-top-green{
        border-top-style: solid;
        border-top-color: green;
        border-top-width: 2px;
    }

    .border-top-red{
        border-top-style: solid;
        border-top-color: red;
        border-top-width: 2px;
    }
</style>

</head>
<body>
    
<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #414c8c; border-bottom:2px solid #d8d8d8;">
    <div class="container-fluid">
        <a class="nav-link" aria-current="page" href="/index"><img width="120" src="{{asset('storage/fotos/logo.png')}}" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/index"><h5 class="mb-2">Home</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/clientes"><h5 class="mb-2">Clientes</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/veiculos"><h5 class="mb-2">Veículos</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/fornecedores"><h5 class="mb-2">Fornecedores</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/locacoes"><h5 class="mb-2">Locação</h5></a>
                </li>
                <li class="nav-item dropdown">                
                    <a style="font-size: 18px !important;" class="nav-link dropdown-toggle " href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b>Caixa</b>
                    </a>                
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li class="itemSubMenu" ><a class="dropdown-item" href="/despesas">Despesas</a></li>
                        <li class="itemSubMenu"><a class="dropdown-item " href="/receitas">Receitas</b></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="itemSubMenu"><a class="dropdown-item " href="/fluxocaixa">Fluxo de caixa</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">                  
                    <b><i style="font-size:22px;" class="bi bi-person-bounding-box mb-4"></i> Olá ,  {{ Auth::user()->name }}!</b>
                  </a>
                      <ul class="dropdown-menu ms-5" aria-labelledby="navbarScrollingDropdown">
                        <li   class="itemSubMenu">                           
                            <form method="POST" class="d-flex"  action="{{ route('logout') }}">
                            @csrf                               
                               <a onclick="event.preventDefault(); this.closest('form').submit();" href="route('logout')" class="dropdown-item text-center"><b><i class="bi bi-box-arrow-right"></i> Encerar</b></a>                               
                            </form>                           
                        </li>                        
                      </ul>
              </li>                
            </ul>
          </div>
    </div>
  </nav>
  <!-- Navbar -->

</header>

<div class = "container-fluid" style="background-color: rgba(236, 237, 244, 0.4); "> 
    <br class="mb-5"/>
        @yield('content')

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted my-5">
        <script>
          $('a[href="' + this.location.pathname + '"]').parents('li,ul').addClass('active');

              $('.itemSubMenu').each(function() {           
                    if ($(this).hasClass('active')) {
      	                $(this).css("background-color", "#414c8c");
                        $("ul.dropdown-menu li.active a").addClass("text-white");

                        $("ul.dropdown-menu li.active a").mouseover(function() {
                            $("ul.dropdown-menu li.active a").removeClass("text-white");                                   
                        });

                        $("ul.dropdown-menu li.active a").mouseout(function() {
                            $("ul.dropdown-menu li.active a").addClass("text-white");                                     
                        });
                    }
               });     
        </script>

      <!-- Copyright -->
      <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2022 Copyright:
        <a class="text-reset fw-bold" href="https://danieasycar.com.br/">danieasycar.com.br</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- JavaScript Bundle with Popper -->

</body>
</html>
