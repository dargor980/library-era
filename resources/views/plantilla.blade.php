<html>
  <meta charset="utf-8"/>
  <meta http-equiv=”Content-Language” content=”es”/>
  <head>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/icon/all.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    
    
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    
    
    <title> @yield('titulo') | MiLibrería </title>
    <link rel="icon" href="/logo.svg"/>
  </head>
  <body class="fondobody" onload="startTime()" style="background: #f5e1ce;">
    
    <script src="{{ asset('js/app.js') }}"  defer></script>
    <script  type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js" defer></script>
    
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light navbargeneral">
      <!--OPCIONES NAVBAR-->
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav ml-md-auto d-none d-md-flex">
          <li class="nav-item active container-fluid">
            <div id="clockdate">
              <div class="clockdate-wrapper row">
                <div id="clock" class="text-white"></div>&nbsp;&nbsp;
                <div id="date" class="text-white"></div>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <!--/OPCIONES NAVBAR-->
    </nav>



    <div class="page-wrapper chiller-theme @unless(Route::currentRouteName() == 'newSale') toggled @endunless">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
          <i class="fa fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
          <div class="sidebar-content">
            <div class="sidebar-brand sidebartitulo shadow-sm">
                <img src="/logo.svg" class="icono" alt="">
                <a href="{{route('home')}}" class="ml-3">Librería "EL OSO"</a>
              <div id="close-sidebar">
                <i class="fa fa-times"></i>
              </div>
            </div>


            <div class="sidebar-menu">
              <ul>
                @guest
                @else
                  <li class="sidebar-dropdown mt-2">
                    <a href="#">
                      <i class="fa fa-user"></i>
                      <span>{{ Auth::user()->name }}</span>
                    </a>
                      <div class="sidebar-submenu">
                        <ul>
                          @if(auth()->user()->id==1)
                          <li>
                            
                          </li>
                          <li>
                            
                          </li>
                          @endif
                          <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>
                           

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            
                          </li>
                        </ul>
                      </div>
                    </li>
                @endguest

                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="fa fa-tachometer"></i>
                    <span>Ventas</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="{{route('newSale')}}" >Nueva Venta</a>
                      </li>
                      <li>
                        <a href="{{route('listSales')}}">Ver Ventas</a>
                      </li>
                    </ul>
                  </div>
                </li>


                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Productos</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="{{route('newProduct')}}">Nuevo Producto</a>
                      </li>
                      <li>
                      <a href="{{route('productList')}}">Ver Productos</a>
                      </li>
                      <li>
                        <a href="{{route('newCategory')}}">Administrar Categorias</a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Proveedores</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="{{route('providerlist')}}">Lista de Proveedores</a>
                      </li>
                      <li>
                        <a href="{{route('newprovider')}}">Nuevo Proveedor</a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="fa fa-archive"></i>
                    <span>Inventario</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="{{route('listStock')}}">Listado de Stock</a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="fa fa-line-chart"></i>
                    <span>Estadísticas de ventas</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="{{ route('dashboard') }}">Historial de Ventas</a>
                      </li>
                      <li>
                        <a href="">Mas Vendidos</a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
            <!-- sidebar-menu  -->
          </div>
          <!-- sidebar-content  -->

        </nav>



        <main class="page-content">
          @yield('contenido')

        </main>
        <!-- page-content" -->

    </div>



    <script>
        jQuery(function ($) {
            $(".sidebar-dropdown > a").click(function() {
            $(".sidebar-submenu").slideUp(200);
            if (
            $(this)
            .parent()
            .hasClass("active")
            ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
            .parent()
            .removeClass("active");
            } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
            .next(".sidebar-submenu")
            .slideDown(200);
            $(this)
            .parent()
            .addClass("active");
            }
            });

            $("#close-sidebar").click(function() {
            $(".page-wrapper").removeClass("toggled");
            });
            $("#show-sidebar").click(function() {
            $(".page-wrapper").addClass("toggled");
            });
        });
    </script>

{{--Script del reloj digital--}}
    <script>
      function startTime() {
        var today = new Date();
        var hr = today.getHours();
        var min = today.getMinutes();
        var sec = today.getSeconds();
        ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
        hr = (hr == 0) ? 12 : hr;
        hr = (hr > 12) ? hr - 12 : hr;
        //Add a zero in front of numbers<10
        hr = checkTime(hr);
        min = checkTime(min);
        sec = checkTime(sec);
        document.getElementById("clock").innerHTML = `<i class="fa fa-clock-o text-white"></i> &nbsp;` + hr + ":" + min + ":" + sec + " " + ap;

        var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        var days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        var curWeekDay = days[today.getDay()];
        var curDay = today.getDate();
        var curMonth = months[today.getMonth()];
        var curYear = today.getFullYear();
        var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
        document.getElementById("date").innerHTML = date;

        var time = setTimeout(function(){ startTime() }, 500);
    }
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    </script>
  {{--Script del reloj digital--}}

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  @yield('scripts')
  </body>



</html>
