<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" href="images/star.png" type="favicon/ico" /> -->

    <title>Mamma's Kitchen</title>

    {{-- CSS --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/list-restaurant.css') }}">  --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/list-restaurant.css') }}"> 


    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/pricing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
    
    {{-- <style>
        @foreach($sliders as $key=>$slider)

            .owl-carousel .owl-wrapper, .owl-carousel .owl-item:nth-child({{ $key + 1 }}) .item
            {
                background: url({{ asset('upload/slider/'.$slider->image) }});
                background-size: cover;
            }      

        @endforeach;
    </style>

    <script src="{{ asset('frontend/js/jquery-1.11.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.flexslider.min.js') }}"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlsContainer: ".flexslider-container"
            });
        });
    </script> --}}

</head>

<body>
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img id="logo" src="{{ asset('frontend/images/Logo_main.png') }}" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarWelcome" 
                aria-controls="navbarWelcome" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>        
                </button>
            
                <div class="collapse navbar-collapse" id="navbarWelcome">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#acerca-de">acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#menu">menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#reservar" tabindex="-1" aria-disabled="true">reservacion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" 
                                data-target="#staticBackdrop">inicio de sesion</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>  
    </div>


    {{-- ACERCA DE --}}
    <div class="row" id="acerca-de">
        <img src="{{ asset('frontend/images/icons/about_color.png') }}" alt="acerca-de" 
        class="img-responsive section-icon d-none d-lg-block d-xl-block">
        <div class="col about-bg d-none d-lg-block d-xl-block"></div>
        <div class="col about-content">
            <h1 class="content-title">Acerca de</h1>
            <p class="content-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Eius iusto numquam corporis asperiores! Amet iste facere cupiditate eos hic in! Ipsum 
                earum dolores ducimus similique voluptatum quas ullam quos dolorum.</p>
            <p class="content-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Eius iusto numquam corporis asperiores! Amet iste facere cupiditate eos hic in! Ipsum 
                earum dolores ducimus similique voluptatum quas ullam quos dolorum.</p>
        </div>
    </div>


    {{-- listado de restaurantes asociados --}}
    <section class="container-fluid" id="listado">
        <div class="row" id="list-filtros">
            <div class="col-md-12 col-offset-1" id="envol-filtros">
                <div class="section-header">
                    <h2 class="rest-title">Menú</h2>
                    <ul class="clearfix" id="list-rest">
                        <li class="filter" data-filter="all">todo</li>
                        @foreach($categories as $category)
                        @if ($category->items->count() > 0)
                            <li class="filter" data-filter="#{{ $category->slug }}">
                                {{ $category->name }}
                                <span class="badge badge-primary badge-pill">{{ $category->items->count() }}</span>
                            </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="restaurantes">
            <div class="col col-md-offset-1" id="contenedor">
                <ul class="listado" id="lista">
                    @foreach($items as $item)
                    <li class="item" id="{{ $item->category->slug }}">
                        <a href="{{ route('restaurant.welcome', $item->id) }}">
                            <img src="{{ asset('upload/item/'.$item->image) }}" class="img-responsive" alt="Food">
                            <div class="rest-desc text-center">
                                <span>
                                    <h3>{{ $item->name }}</h3>
                                    Descripcion: {{ $item->description}} <br>
                                    
                                </span>
                            </div>
                        </a>
                        <h2 class="white">{{ $item->price }}</h2>
                    </li>                    
                    @endforeach
                </ul>
            </div>
        </div>
    </section>


    <!--== 15. Reserve A Table! ==-->
    {{-- <section id="reserve" class="reserve">
        <img class="img-responsive section-icon hidden-sm hidden-xs" src="{{ asset('frontend/images/icons/reserve_black.png') }}">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row dis-table">
                    <div class="col-xs-6 col-sm-6 dis-table-cell color-bg">
                        <h2 class="section-title">Reserve A Table !</h2>
                    </div>
                    <div class="col-xs-6 col-sm-6 dis-table-cell section-bg">

                    </div>
                </div> <!-- /.dis-table -->
            </div> <!-- /.row -->
        </div> <!-- /.wrapper -->
    </section> <!-- /#reserve -->


    <section class="reservation">
        <img class="img-responsive section-icon hidden-sm hidden-xs" src="{{ asset('frontend/images/icons/reserve_color.png') }}">
        <div class="wrapper">
            <div class="container-fluid">
                <div class=" section-content">
                    <div class="row">
                        <div class="col-md-5 col-sm-6">
                            <form class="reservation-form" method="post" action="{{ route('reservation.reserve') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control reserve-form empty iconified" 
                                            name="name" id="name" required="required" placeholder="  &#xf007;  Nombre">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control reserve-form empty iconified" 
                                            id="email" required="required" placeholder="  &#xf1d8;  e-mail">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="tel" class="form-control reserve-form empty iconified" 
                                            name="phone" id="phone" required="required" placeholder="  &#xf095;  Telefono">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control reserve-form empty iconified" 
                                            name="dateandtime" id="datetimepicker1" required="required" 
                                            placeholder="&#xf017;  Hora">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <textarea type="text" name="message" class="form-control reserve-form empty iconified" 
                                        id="message" rows="3" required="required" placeholder=" &#xf086;  Detalles de la Reservación"></textarea>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <button type="submit" id="submit" name="submit" class="btn btn-reservation">
                                            <span><i class="fa fa-check-circle-o"></i></span>
                                            Hacer Reservacion
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    {{-- ubicacion especifica --}}
    <section id="ubicacion">
        <div class="container-fluid">
            <div class="row" id="ubicaciones">
                <div class="col ubicacion-bg d-none d-lg-block d-xl-block"></div>
                <div class="col ubicacion-content">
                    <h1 class="content-title">Ubicaciones</h1>
                    <p class="content-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Eius iusto numquam corporis asperiores! Amet iste facere cupiditate eos hic in! Ipsum 
                        earum dolores ducimus similique voluptatum quas ullam quos dolorum.</p>
                    <p class="content-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Eius iusto numquam corporis asperiores! Amet iste facere cupiditate eos hic in! Ipsum 
                        earum dolores ducimus similique voluptatum quas ullam quos dolorum.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- mapa --}}
    <div class="container-fluid">
        <div class="row">
            <div id="map-canvas"></div>
        </div>
    </div>


    {{-- pie de pagina --}}
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-offset-3">
                    <div class="copyright text-center">
                        <p>
                            &copy; Copyright, 2019 <a href="#">Nombre de la aplicacion</a> Desarrollado por <a href="">Jose Asencio Bermudez</a> & <a href="">Erick Briones Dominguez</a> 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="{{ asset ('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('frontend/js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset ('frontend/js/popper.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
    crossorigin="anonymous"></script> --}}


<script src="frontend/js/jquery.mixitup.min.js"></script>
<script src="frontend/js/main.js"></script>
<script src="{{ asset('frontend/js/bootstrap-datetimepicker.min.js') }}"></script>

    {{-- <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.hoverdir.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('frontend/js/jQuery.scrollSpeed2.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}');
            </script>
        @endforeach
    @endif     --}}

    {{-- <script>
    $(document).ready(function(){
        $(window).scroll(function(){
            if ($(document).scrollTop() > 50) {
                $("nav").addClass("shrink");
            } else {
                $("nav").removeClass("shrink");
            }
        });
    });
    
    $(document).ready(function() {
        $(window).scroll(function () {
           if ($(document).scrollTop() > 50) {
               $("#logo").attr("src", "{{ asset('frontend/images/Logo_stick.png') }}")
           } else {
            $("#logo").attr("src", "{{ asset('frontend/images/Logo_main.png') }}")
           } 
        });
    });
</script>


    <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: "dd MM yyyy - HH:11 P",
                    showMeridian: true,
                    autoclose: true,
                    todayBtn: true
                });
            });
            
    </script> --}}
{{-- {!! Toastr::message() !!} --}}
</body>

</html>