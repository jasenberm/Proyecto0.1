<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" href="images/star.png" type="favicon/ico" /> -->

    <title>Mamma's Kitchen</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/list-restaurant.css') }}"> 


    {{-- prueba de reservaciones --}}
    
<!--===============================================================================================-->
	
<!--===============================================================================================-->
	
<!--===============================================================================================-->
	{{-- <link rel="stylesheet" type="text/css" href="frontend/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="frontend/vendor/animsition/css/animsition.min.css"> --}}
<!--===============================================================================================-->
    {{-- <link rel="stylesheet" type="text/css" href="frontend/vendor/select2/select2.min.css"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/select2.min.css') }}">

<!--===============================================================================================-->
	{{-- <link rel="stylesheet" type="text/css" href="frontend/vendor/daterangepicker/daterangepicker.css"> --}}
<!--===============================================================================================-->
	{{-- <link rel="stylesheet" type="text/css" href="frontend/vendor/slick/slick.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="frontend/vendor/lightbox2/css/lightbox.min.css">  --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main2.css') }}">



    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/pricing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datetimepicker.min.css') }}">--}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
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
                            <a class="nav-link" href="#listado">menú</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#ubicacion">ubicación</a>
                        </li>                                                
                        @guest
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Reservar</a>
                            </li> 
                            <li class="nav-item">
                                {{-- <a class="nav-link" data-toggle="modal" 
                                    data-target="#staticBackdrop">inicio de sesion</a> --}}
                                    <a class="nav-link" href="{{ route('login') }}">inicio de sesion</a>
                            </li>
                        @else  
                        <li class="nav-item">
                            <a class="nav-link" href="#reservar">Reservar</a>
                        </li>                       
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->user }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
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
                        <h2 class="white">${{ $item->price }}</h2>
                    </li>                    
                    @endforeach
                </ul>
            </div>
        </div>
    </section>


    <!--== 15. Reserve A Table! ==-->
    <section class="section-reservation bg1-pattern p-t-100 p-b-113" id="reservar">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 p-b-30">
					<div class="t-center">
						<span class="tit2 t-center">
							Reservación
						</span>

						<h3 class="tit3 t-center m-b-35 m-t-2">
							Reserva tu mesa
						</h3>
					</div>

                    <form method="POST" action="{{ route('reservation.reserve', $restaurant->id) }}" class="wrap-form-reservation size22 m-l-r-auto">
                        @csrf
                        <div class="row">
							<div class="col-md-4">
								<!-- Date -->
								<span class="txt9">
									Día
								</span>

								<div class="wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<input class="my-calendar bo-rad-10 sizefull txt10 p-l-20" type="text" name="date">
									<i class="btn-calendar fa fa-calendar ab-r-m hov-pointer m-r-18" aria-hidden="true"></i>
								</div>
							</div>

							<div class="col-md-4">
								<!-- Time -->
								<span class="txt9">
									Hora
								</span>

								<div class="wrap-inputtime size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<!-- Select2 -->
									<select class="selection-1" name="time">
										<option>9:00</option>
										<option>9:30</option>
										<option>10:00</option>
										<option>10:30</option>
										<option>11:00</option>
										<option>11:30</option>
										<option>12:00</option>
										<option>12:30</option>
										<option>13:00</option>
										<option>13:30</option>
										<option>14:00</option>
										<option>14:30</option>
										<option>15:00</option>
										<option>15:30</option>
										<option>16:00</option>
										<option>16:30</option>
										<option>17:00</option>
										<option>17:30</option>
										<option>18:00</option>
									</select>
								</div>
							</div>

							<div class="col-md-4">
								<!-- People -->
								<span class="txt9">
									personas
								</span>

								<div class="wrap-inputpeople size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<!-- Select2 -->
									<select class="selection-1" name="people">
										<option>1 persona</option>
										<option>2 personas</option>
										<option>3 personas</option>
										<option>4 personas</option>
										<option>5 personas</option>
										<option>6 personas</option>
										<option>7 personas</option>
										<option>8 personas</option>
										<option>9 personas</option>
										<option>10 personas</option>
										<option>11 personas</option>
										<option>12 personas</option>
									</select>
								</div>
							</div>
                        </div>

                        <div class="col-md-12">                            
                            <span class="txt9">
                                Mensaje
                            </span>

                            <div class="wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                <textarea class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="message" rows="3"></textarea>                                
                            </div>
                        </div>

                        @guest
                        <div class="t-center">
                            <span class="tit2 t-center">
                                Inicia sesión para realizar su reservación
                            </span>
                        </div>
                        @else
                            <div class="wrap-btn-booking flex-c-m m-t-6">
							    <!-- Button3 -->
							    <button type="submit" class="btn3 flex-c-m size13 txt11 trans-0-4">
								    Reservar
							    </button>
						    </div>
                        @endguest
						
					</form>
				</div>
			</div>

			{{-- <div class="info-reservation flex-w p-t-80">
				<div class="size23 w-full-md p-t-40 p-r-30 p-r-0-md">
					<h4 class="txt5 m-b-18">
						Reserve by Phone
					</h4>

					<p class="size25">
						Donec quis euismod purus. Donec feugiat ligula rhoncus, varius nisl sed, tincidunt lectus.
						<span class="txt25">Nulla vulputate</span>
						, lectus vel volutpat efficitur, orci
						<span class="txt25">lacus sodales</span>
						 sem, sit amet quam:
						<span class="txt24">(001) 345 6889</span>
					</p>
				</div>

				<div class="size24 w-full-md p-t-40">
					<h4 class="txt5 m-b-18">
						For Event Booking
					</h4>

					<p class="size26">
						Donec feugiat ligula rhoncus:
						<span class="txt24">(001) 345 6889</span>
						, varius nisl sed, tinci-dunt lectus sodales sem.
					</p>
				</div>

			</div> --}}
		</div>
	</section>


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


    {{-- <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('frontend/js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
    crossorigin="anonymous"></script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
    crossorigin="anonymous"></script>


    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" 
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" 
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> --}}


<script src="{{ asset('frontend/js/jquery.mixitup.min.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
{{-- <script src="frontend/js/bootstrap-datetimepicker.min.js"></script> --}}


{{-- prueba para la reservacion --}}
<!--===============================================================================================-->

<!--===============================================================================================-->
	{{-- <script type="text/javascript" src="frontend/vendor/animsition/js/animsition.min.js"></script> --}}
<!--===============================================================================================-->
	
	
<!--===============================================================================================-->
    {{-- <script src="{{ asset('frontend/vendor/select2/select2.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}
    <script type="text/javascript" src="{{ asset('frontend/js/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/js/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	{{-- <script type="text/javascript" src="frontend/vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="frontend/js/slick-custom.js"></script> --}}
<!--===============================================================================================-->
	{{-- <script type="text/javascript" src="frontend/vendor/parallax100/parallax100.js"></script>
	<script type="text/javascript">
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="frontend/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="frontend/vendor/lightbox2/js/lightbox.min.js"></script> --}}
<!--===============================================================================================-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	

<script type="text/javascript">
    /*[ Daterangepicker ]
    ===========================================================*/
    $('.my-calendar').daterangepicker({
        "singleDatePicker": true,
        "showDropdowns": true,
        locale: {
            format: 'DD/MM/YYYY'
        },
    });

    var myCalendar = $('.my-calendar');
    var isClick = 0;

    $(window).on('click',function(){ 
        isClick = 0;
    });

    $(myCalendar).on('apply.daterangepicker',function(){ 
        isClick = 0;
    });

    $('.btn-calendar').on('click',function(e){ 
        e.stopPropagation();

        if(isClick == 1) isClick = 0;   
        else if(isClick == 0) isClick = 1;

        if (isClick == 1) {
            myCalendar.focus();
        }
    });

    $(myCalendar).on('click',function(e){ 
        e.stopPropagation();
        isClick = 1;
    });

    $('.daterangepicker').on('click',function(e){ 
        e.stopPropagation();
    });

    $(".selection-1").select2();
    
    
</script> 
    
    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}');
            </script>
        @endforeach
    @endif --}}
    
    {!! Toastr::message() !!}
</body>

</html>