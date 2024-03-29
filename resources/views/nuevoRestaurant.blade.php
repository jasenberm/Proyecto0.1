<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('frontend/images/icons/ejemplo3.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	 <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/select2/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/slick/slick.css') }}">
<!--===============================================================================================-->
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/utilCambio.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/mainCambio.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/list-restaurant.css') }}"> 
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

	<!--Mapa-->	
	<link href="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css" rel="stylesheet" />

</head>
<body class="animsition">

	<!-- Header -->
	<header>
		<!-- Header desktop --> <!-- navbar -->
		<div class="wrap-menu-header gradient1 trans-0-4">
			<div class="container h-full">
				<div class="wrap_header trans-0-3">
					<!-- Logo -->
					<div class="logo">
						<a href="/">
							<img src="{{ asset('frontend/images/icons/ejemplo.png') }}" alt="IMG-LOGO" data-logofixed="{{ asset('frontend/images/icons/ejemplo2.png') }}">
						</a>
					</div>

					<!-- Menu -->
					<div class="wrap_menu p-l-45 p-l-0-xl">
						<nav class="menu">
							<ul class="main_menu">
								<li>
									<a href="/">Inicio</a>
								</li>

								<li>
									<a href="#restaurantes">Menú</a>
								</li>								
								
								<li>
									<a href="#ubicacion">Ubicación</a>
								</li>								
								@guest
								<li class="nav-item">
									{{-- <a class="nav-link" data-toggle="modal" 
										data-target="#staticBackdrop">inicio de sesion</a> --}}
										{{-- <a class="nav-link" href="{{ route('login') }}">inicio de sesion</a> --}}
										<a class="nav-link" onClick="iniciarsession();" href="javascript:void(0)">Iniciar sesión</a>
								</li>
								@else          
								<li class="nav-item">
									<a class="nav-link" href="#reservar">Reservación</a>
								</li>                
								<li class="nav-item dropdown">
									<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
										{{ Auth::user()->user }} <span class="caret"></span>
									</a>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalReservations">Mis Reservaciones</a>
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
						</nav>
					</div>
					
					<div class="social flex-w flex-l-m p-r-20">						
						<button class="btn-show-sidebar m-l-33 trans-0-4"></button>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- modales -->
	@include('layouts.partial.reservations')

	<!-- Sidebar --> <!-- boton de expander -->
	<aside class="sidebar trans-0-4">
		<!-- Button Hide sidebar -->
		<button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

		<!-- - -->
		<ul class="menu-sidebar p-t-95 p-b-70">
			<li class="t-center m-b-13">
				<a href="/" class="txt19">Inicio</a>
			</li>

			<li class="t-center m-b-13">
				<a href="#restaurantes" class="txt19">Menú</a>
			</li>
			
			<li class="t-center m-b-33">
				<a href="#ubicacion" class="txt19">Ubicación</a>
			</li>

			@guest
			<li class="t-center">
				<!-- Button3 -->
				{{-- <a href="{{ route('login') }}" class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto">
					Iniciar Sesion
				</a> --}}
				<a class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto" onClick="iniciarsession();" href="javascript:void(0)">
					Iniciar sesión
				</a>
			</li>
			@else       
			<li class="t-center m-b-13">
				<a href="#reservar" class="txt19">Reservación</a>
			</li>
			
			<li class="t-center">
				<a class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto" href="{{ route('logout') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
					{{ __('Logout') }}
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
				</form>
			</li>
			@endguest
		</ul>

		<!-- - -->
		<div class="gallery-sidebar t-center p-l-60 p-r-60 p-b-40">
			<!-- - -->
			<h4 class="txt20 m-b-33">
				Gallery
			</h4>

			<!-- Gallery -->
			<div class="wrap-gallery-sidebar flex-w">
				@foreach ($items as $item)					
				<a class="item-gallery-sidebar wrap-pic-w" href="{{ route('restaurant.welcome', $item->id) }}">
					<img src="{{ asset('upload/item/'.$item->image) }}" alt="GALLERY">
				</a>
				@endforeach
			</div>
		</div>
	</aside>

	<!-- Welcome --> <!-- imagen y mensaje de bienvenida -->
	<section class="section-welcome bg1-pattern p-t-120 p-b-105" id="bienvenida">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-t-45 p-b-30">
					<div class="wrap-text-welcome t-center">
						<span class="tit2 t-center">
							{{ $restaurant->name_restaurant }}
						</span>

						<h3 class="tit3 t-center m-b-35 m-t-5">
							Bienvenido
						</h3>

						<p class="t-center m-b-22 size3 m-l-r-auto">
							{{ $restaurant->description }}
						</p>
						
					</div>
				</div>

				<div class="col-md-6 p-b-30">
					<div class="wrap-pic-welcome size2 bo-rad-10 hov-img-zoom m-l-r-auto">
						<img src="{{ asset('upload/restaurant/'.$restaurant->image) }}" alt="IMG-OUR" style="margin-top: 30px">
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Intro -->
	<section class="section-intro" id="restaurantes">
		<div class="header-intro parallax100 t-center p-t-135 p-b-158" style="background-image: url('{{ asset('frontend/images/menu.jpg') }}');">
			<span class="tit2 p-l-15 p-r-15">
				Descubre
			</span>

			<h3 class="tit4 t-center p-l-15 p-r-15 p-t-3">
				Nuestro Menú
			</h3>
		</div>

		<div class="container">
			<div class="row" id="list-filtros">
				<div class="col-md-12 col-offset-1" id="envol-filtros">
					<div class="section-header">
						<h2 class="tit2">Menú</h2>
						<ul class="clearfix" id="list-rest">
							<li class="filter txt13" data-filter="all">todo</li>
							@foreach($categories as $category)
							@if ($category->items->count() > 0)
							<li class="filter txt13" data-filter="#{{ $category->slug }}" href="/{{ $restaurant->id }}/?category={{ $category->slug }}">
								{{ $category->name }}
								{{-- <span class="badge badge-primary badge-pill">{{ $category->items->count() }}</span> --}}
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
						<li class="item bo-rad-10" id="{{ $item->slug }}">
							<a>
								<img src="{{ asset('upload/item/'.$item->image) }}" class="img-responsive" alt="Food">
								<div class="rest-desc text-center">
									<span>
										<h3>{{ $item->name }}</h3>
										Descripcion: {{ $item->description}} <br>
										
									</span>
								</div>
							</a>
							<h2 class="white">US$ {{ $item->price }}</h2>
						</li>                    
						@endforeach
					</ul>											
					{{ $items->links() }}					
				</div>
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
										<option>18:30</option>
										<option>19:00</option>
										<option>19:30</option>
										<option>20:00</option>
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
										<option>5 o más personas</option>										
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
									Reservación
								</button>
							</div>
						@endguest
						
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- contact -->
	<section class="section-contact p-t-90 p-b-113" id="ubicacion">
		<!-- Map -->
		<div class="container">
			<div class="col-lg-12 p-b-30">
				<div class="t-center">
					<span class="tit2 t-center">
						Contacta con nosostros
					</span>

					<h3 class="tit3 t-center m-b-35 m-t-2">
						Ubicación
					</h3>
				</div>
			</div>
			<div class="map bo8 bo-rad-10 of-hidden">
				<div class="contact-map size37" id="map-canvas"></div>
			</div>
		</div>

		<div class="container">
			<h3 class="tit3 t-center m-b-35 m-t-2">
				Enviar un mensaje
			</h3>

			<form method="POST" action="{{ route('contact.send', $restaurant->id) }}" class="wrap-form-reservation size22 m-l-r-auto">
				@csrf
				<div class="row">
					<div class="col-12">
						<!-- Message -->
						<span class="txt9">
							Mensaje
						</span>
						<textarea class="bo-rad-10 size35 bo2 txt10 p-l-20 p-t-15 m-b-10 m-t-3" rows="3" name="message" placeholder="Mensaje"></textarea>
					</div>
				</div>

				@guest
				<div class="t-center">
					<span class="tit2 t-center">
						Inicia sesión para enviar su mensaje
					</span>
				</div>
				@else
				<div class="wrap-btn-booking flex-c-m m-t-13">
				<!-- Button3 -->
					<button type="submit" class="btn3 flex-c-m size36 txt11 trans-0-4">
						Enviar
					</button>
				</div>
				@endguest				
			</form>		
		</div>
		
		<div class="row justify-content-center">
			@if ($restaurant->instagram == !null)				
			<div style="margin-top: 40px; margin-right: 40px">
				<a href="{{ $restaurant->instagram }}" class="" style="font-size: 3em;" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>				
			</div>
			@endif

			@if ($restaurant->facebook == !null)				
			<div style="margin-top: 40px; margin-right: 40px">
				<a href="{{ $restaurant->facebook }}" class="" style="font-size: 3em;" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>				
			</div>
			@endif

			@if ($restaurant->twiter == !null)				
			<div style="margin-top: 40px; margin-right: 40px">
				<a href="{{ $restaurant->twiter }}" class="" style="font-size: 3em;" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			</div>
			@endif
		</div>
	</section>

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>

	<!-- Modal Video 01-->



<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/vendor/bootstrap/js/popper.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/vendor/daterangepicker/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/vendor/daterangepicker/daterangepicker.js') }}"></script>	
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/vendor/slick/slick.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/vendor/parallax100/parallax100.js') }}"></script>
	<script type="text/javascript">
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('frontend/vendor/lightbox2/js/lightbox.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('frontend/js/mainCambio.js') }}"></script>
	<script src="{{ asset('frontend/js/main.js') }}"></script>
	<script src="{{ asset('frontend/js/main2.js') }}"></script>
	<script src="{{ asset('frontend/js/script.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.mixitup.min.js') }}"></script>	

	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<!--Mapa-->
	<script src="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.js"></script>
	<script>
		mapboxgl.accessToken = 'pk.eyJ1IjoiamFzZW5iZXJtIiwiYSI6ImNqeXhpZDFmbDA3a2YzY28xcW5kMWI3ajMifQ.CdmHunZbUBpmZPYvK0_HyA';
		if (!mapboxgl.supported()) {
			alert('Your browser does not support Mapbox GL');
		} else {
			var lng = {{ $restaurant->lng }};
    		var lat = {{ $restaurant->lat }};

			var map = new mapboxgl.Map({
				container: 'map-canvas', // container id
				style: 'mapbox://styles/mapbox/streets-v11',
				center: [lng, lat], // starting position
				zoom: 14, // starting zoom
				scrollZoom: false
			});
			
			// Add zoom and rotation controls to the map.
			map.addControl(new mapboxgl.NavigationControl());

			map.addControl(
				new mapboxgl.GeolocateControl({
					positionOptions: {
						enableHighAccuracy: true,					
					},
					trackUserLocation: true,
					fitBoundsOptions: {
						zoom:14
					}
				})
			);

			map.addControl(new mapboxgl.FullscreenControl());

			// add markers
			var marker = new mapboxgl.Marker({
				draggable: false
			})
			.setLngLat([lng, lat])
			.addTo(map);
		}
	</script>
    <!--Fin mapa-->
	<script>
		function iniciarsession(){
			$('#login-modal').modal('show');
		}		
	</script>
	@toastr_render
</body>
</html>

@include('layouts.partial.reservations')
@include('security.login-modal')	