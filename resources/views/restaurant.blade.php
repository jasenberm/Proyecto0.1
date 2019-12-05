<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" href="images/star.png" type="favicon/ico" /> -->

    <title>Mamma's Kitchen</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        crossorigin="anonymous">
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

<body data-spy="scroll" data-target="#template-navbar">

    <!--== 4. Navigation ==-->
    {{-- <nav id="template-navbar" class="navbar navbar-default custom-navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#Food-fair-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="Food-fair-toggle">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#about">Acerca de</a></li>
                    <li><a href="#menu-list">Menu</a></li>
                    <li><a href="#reserve">Reservacion</a></li>
                    <li><a href="#contact">Ubicaciones</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.row -->
    </nav> --}}

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
                            <a class="nav-link" href="#">acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">reservacion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" 
                                data-target="#staticBackdrop">inicio de sesion</a>
                        </li>
                        {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                        </li> 
                        <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">
                            Disabled</a>
                        </li>--}}
                    </ul>
                </div>
            </nav>
        </div>  
    </div>


    <!--== 5. Header ==-->
    {{-- <section id="header-slider" class="owl-carousel">
        @foreach ($sliders as $key=>$slider)
            <div class="item">
                <div class="container">
                    <div class="header-content">
                        <h1 class="header-title">{{ $slider->title }}</h1>
                        <p class="header-sub-title">{{ $slider->sub_title }}</p>
                    </div> <!-- /.header-content -->
                </div>
            </div>
        @endforeach
    </section> --}}


    <!--== 6. About us ==-->
    {{-- <section id="about" class="about">
        <img src="{{ asset('frontend/images/icons/about_color.png') }}" class="img-responsive section-icon hidden-sm hidden-xs">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row dis-table">
                    <div class="hidden-xs col-sm-6 section-bg about-bg dis-table-cell">

                    </div>
                    <div class="col-xs-12 col-sm-6 dis-table-cell">
                        <div class="section-content">
                            <h2 class="section-content-title">Acerca de </h2>
                            <p class="section-content-para">
                                Astronomy compels the soul to look upward, and leads us from this world to another. Curious that we spend more time congratulating people who have succeeded than encouraging people who have not. As we got further and further away, it [the Earth] diminished in size.
                            </p>
                            <p class="section-content-para">
                                beautiful, warm, living object looked so fragile, so delicate, that if you touched it with a finger it would crumble and fall apart. Seeing this has to change a man. Where ignorance lurks, so too do the frontiers of discovery and imagination.
                            </p>
                        </div> <!-- /.section-content -->
                    </div>
                </div> <!-- /.row -->
            </div> <!-- /.container-fluid -->
        </div> <!-- /.wrapper -->
    </section> <!-- /#about --> --}}

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


    <!--==  7. Afordable Pricing  ==-->
    <section id="menu-list" class="menu-list">
        <div id="w">
            <div class="pricing-filter">
                <div class="pricing-filter-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="section-header">
                                    <h2 class="pricing-title">Lista de Restaurantes Asociados</h2>
                                    <ul id="filter-list" class="clearfix">
                                        <li class="filter" data-filter="all">Todo</li>
                                        @foreach($categories as $category)
                                            <li class="filter" data-filter="#{{ $category->slug }}">{{ $category->name }}
                                                <span class="badge">{{ $category->items->count() }}</span>
                                            </li>
                                        @endforeach
                                    </ul><!-- @end #filter-list -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <ul id="menu-pricing" class="menu-price">
                            @foreach($items as $item)
                                <li class="item" id="{{ $item->category->slug }}">
                                    <a href="{{ route('restaurant.welcome', $item->id) }}">
                                        <img src="{{ asset('upload/item/'.$item->image) }}" 
                                            class="img-responsive" alt="Item" style="height:300px; width:369px;">
                                        <div class="menu-desc text-center">
                                            <span>
                                                <h3>{{ $item->name }}</h3><br>
                                                    Descripcion: {{ $item->description}} <br>
                                            </span>
                                        </div>
                                    </a>
                                    <h2 class="white">{{ $item->price }}</h2>
                                </li>
                            @endforeach
                        </ul>

                        <!-- <div class="text-center">
                                    <a id="loadPricingContent" class="btn btn-middle hidden-sm hidden-xs">Load More <span class="caret"></span></a>
                            </div> -->

                    </div>
                </div>
            </div>

        </div>
    </section>


    <!--== 15. Reserve A Table! ==-->
    <section id="reserve" class="reserve">
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

                        <div class="col-md-2 hidden-sm hidden-xs"></div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="opening-time">
                                <h3 class="opening-time-title">Hours</h3>
                                <p>Mon to Fri: 7:30 AM - 9:30 PM</p>
                                <p>Sat & Sun: 8:00 AM - 11:30 PM</p>

                                <div class="launch">
                                    <h4>Lunch</h4>
                                    <p>Mon to Fri: 12:00 PM - 5:00 PM</p>
                                </div>

                                <div class="dinner">
                                    <h4>Dinner</h4>
                                    <p>Mon to Sat: 6:00 PM - 1:00 AM</p>
                                    <p>Sun: 5:30 PM - 12:00 AM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section id="contact" class="contact">
        <div class="container-fluid color-bg">
            <div class="row dis-table">
                <div class="hidden-xs col-sm-6">
                    <h3 class="section-title">Contacte con Nosostros</h3>
                </div>
                <div class="col-xs-6 col-sm-6 dis-table-cell">
                    
                </div>
            </div>
        </div>
    </section>


    <section class="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <div class="row">
                        <form class="contact-form" method="post" action="{{ route('contact.send') }}">
                            @csrf
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control" id="name" required="required" placeholder="  Name">
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control" id="email" required="required" placeholder="  Email">
                                </div>
                                <div class="form-group">
                                    <input name="subject" type="text" class="form-control" id="subject" required="required" placeholder="  Subject">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <textarea name="message" type="text" class="form-control" id="message" rows="7" required="required" placeholder="  Message"></textarea>
                            </div>

                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div class="text-center">
                                    <button type="submit" id="submit" name="submit" class="btn btn-send">Send </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div id="map-canvas"></div>
        </div>
    </div>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="copyright text-center">
                        <p>
                            &copy; Copyright, 2019 <a href="#">Nombre de la aplicacion</a> Desarrollado por <a href="">Jose Asencio Bermudez</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
    crossorigin="anonymous"></script>


<script src="{{ asset('frontend/js/jquery.mixitup.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
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

    <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: "dd MM yyyy - HH:11 P",
                    showMeridian: true,
                    autoclose: true,
                    todayBtn: true
                });
            });
            
    </script>
{{-- {!! Toastr::message() !!} --}}
</body>

</html>