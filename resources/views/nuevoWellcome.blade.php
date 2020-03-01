<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('frontend/images/icons/favicon.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	 <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/select2/select2.min.css') }}">
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
							<img src="{{ asset('frontend/images/icons/logo.png') }}" alt="IMG-LOGO" data-logofixed="{{ asset('frontend/images/icons/logo2.png') }}">
						</a>
					</div>

					<!-- Menu -->
					<div class="wrap_menu p-l-45 p-l-0-xl">
						<nav class="menu">
							<ul class="main_menu">
								<li>
									<a href="#bienvenida">Inicio</a>
								</li>

								<li>
									<a href="#restaurantes">Restaurantes</a>
								</li>								

								<li>
									<a href="#menu">Menus</a>
								</li>
								
								<li>
									<a href="#ubicacion">Ubicacion</a>
								</li>
								@guest
								<li class="nav-item">
									{{-- <a class="nav-link" data-toggle="modal" 
										data-target="#staticBackdrop">inicio de sesion</a> --}}
										<a class="nav-link" href="{{ route('login') }}">inicio de sesion</a>
								</li>
								@else                        
								<li class="nav-item dropdown">
									<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
										{{ Auth::user()->user }} <span class="caret"></span>
									</a>

									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

	<!-- Sidebar --> <!-- boton de expander -->
	<aside class="sidebar trans-0-4">
		<!-- Button Hide sidebar -->
		<button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

		<!-- - -->
		<ul class="menu-sidebar p-t-95 p-b-70">
			<li class="t-center m-b-13">
				<a href="#bienvenida" class="txt19">Inicio</a>
			</li>

			<li class="t-center m-b-13">
				<a href="#restaurantes" class="txt19">Restaurantes</a>
			</li>

			<li class="t-center m-b-13">
				<a href="#menu" class="txt19">Menus</a>
			</li>

			<li class="t-center m-b-13">
				<a href="#ubicacion" class="txt19">Ubicación</a>
			</li>

			@guest
			<li class="t-center">
				<!-- Button3 -->
				<a href="{{ route('login') }}" class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto">
					Iniciar Sesion
				</a>
			</li>
			@else                        
			<li class="t-center">
				{{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					{{ Auth::user()->user }} <span class="caret"></span>
				</a> --}}

				{{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
					<a class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto" href="{{ route('logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
					</form>
				{{-- </div> --}}
			</li>
			@endguest
		</ul>

		<!-- - -->
		{{-- <div class="gallery-sidebar t-center p-l-60 p-r-60 p-b-40">
			<!-- - -->
			<h4 class="txt20 m-b-33">
				Gallery
			</h4>

			<!-- Gallery -->
			<div class="wrap-gallery-sidebar flex-w">
				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-01.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-01.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-02.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-02.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-03.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-03.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-05.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-05.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-06.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-06.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-07.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-07.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-09.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-09.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-10.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-10.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-11.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-11.jpg" alt="GALLERY">
				</a>
			</div>
		</div> --}}
	</aside>

	<!-- Welcome --> <!-- imagen y mensaje de bienvenida -->
	<section class="section-welcome bg1-pattern p-t-120 p-b-105" id="bienvenida">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-t-45 p-b-30">
					<div class="wrap-text-welcome t-center">
						<span class="tit2 t-center">
							Encuentra tu restaurante
						</span>

						<h3 class="tit3 t-center m-b-35 m-t-5">
							Bienvenido
						</h3>

						<p class="t-center m-b-22 size3 m-l-r-auto">
							Donec quis lorem nulla. Nunc eu odio mi. Morbi nec lobortis est. Sed fringilla, nunc sed imperdiet lacinia, nisl ante egestas mi, ac facilisis ligula sem id neque.
						</p>
						<p class="t-center m-b-22 size3 m-l-r-auto">
							Si desea publicitar su negocio a travez de nuestra plataforma, inicie el proceso en el siguiente enlace.
						</p>

						<a href="{{ route('register_owner') }}" class="txt4">
							Trabaja con nosotros
							<i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
						</a>
					</div>
				</div>

				<div class="col-md-6 p-b-30">
					<div class="wrap-pic-welcome size2 bo-rad-10 hov-img-zoom m-l-r-auto">
						<img src="{{ asset('frontend/images/About-C-bg.jpg') }}" alt="IMG-OUR">
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
				Restaurantes
			</h3>
		</div>
		
		<div class="container">
			<div class="row" id="list-filtros">
				<div class="col-md-12 col-offset-1" id="envol-filtros">
					<div class="section-header">
						<h2 class="tit2">Lista de restaurantes asociados</h2>
						<ul class="clearfix" id="list-rest">
							<li class="filter txt13" data-filter="all">todo</li>
							@foreach($categoryRestaurants as $category)
							@if ($category->restaurants->where('status', 1)->count() > 0)
								<li class="filter txt13" data-filter="#{{ $category->slug }}">
									{{ $category->name }}
									<span class="badge badge-primary badge-pill">{{ $category->restaurants->where('status', 1)->count() }}</span>
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
						@foreach($restaurants as $restaurant)
						<li class="item bo-rad-10" id="{{ $restaurant->category_restaurant->slug }}">
							<a href="{{ route('restaurant.welcome', $restaurant->id) }}">
								<img src="{{ asset('upload/restaurant/'.$restaurant->image) }}" class="img-responsive bo-rad-10" alt="Food">
								<div class="rest-desc text-center">
									<span>
										<h4>{{ $restaurant->name_restaurant }}</h4>
										<br>
										Direccion: {{ $restaurant->address }} <br>
													
										{{-- Descripcion: {{ $restaurant->description}} <br> --}}
									</span>
								</div>
							</a>
							<p class="flex-c-m" style="font-family: Courgette; font-size: 20px">{{ $restaurant->name_restaurant }}</p>
						</li>                    
						@endforeach
					</ul>
					{{ $restaurants->links() }}
				</div>
			</div>
		</div>
	</section>

	<!-- Our menu --><!-- menu / lista de restaurantes -->
	<section class="section-ourmenu bg2-pattern p-t-115 p-b-120" id="menu">
		{{-- <div class="container"> --}}
			<div class="title-section-ourmenu t-center m-b-22">
				<span class="tit2 t-center">
					Descubre
				</span>

				<h3 class="tit5 t-center m-t-2">
					Nuestros Menus
				</h3>
			</div>					
				<div class="container">
					<div class="row" id="lista2">						
						@foreach ($items as $item)	
						<div class="col-md-3" style="margin-top:20px">
							<!-- Item our menu -->
							<div class="bo-rad-10 hov-img-zoom">
								<img src="{{ asset('upload/item/'.$item->image) }}" class="img-responsive" alt="Food"
								style="width: 100%; height: 300px;">
	
								<!-- Button2 -->
								<a href="{{ route('restaurant.welcome', $item->id) }}" class="btn2 flex-c-m txt5 ab-c-m size7">
									ver menu									
								</a>
							</div>
						</div>
						@endforeach				
					</div>					
			</div>
		</div>	
	</section>


	{{-- mapa
    <div class="container-fluid">
        <div class="row">
            <div id="map-canvas"></div>
        </div>
    </div> --}}



	<!-- contact -->
	<section class="section-contact bg1-pattern p-t-90 p-b-113">
		<!-- Map -->
		<div class="container">
			<div class="map bo8 bo-rad-10 of-hidden">
				<div class="contact-map size37" id="map-canvas"></div>
			</div>
		</div>

		{{-- <div class="container">
			<h3 class="tit7 t-center p-b-62 p-t-105">
				Enviar un mensaje
			</h3>

			<form class="wrap-form-reservation size22 m-l-r-auto">
				<div class="row">
					<div class="col-12">
						<!-- Message -->
						<span class="txt9">
							Mensaje
						</span>
						<textarea class="bo-rad-10 size35 bo2 txt10 p-l-20 p-t-15 m-b-10 m-t-3" name="message" placeholder="Mensaje"></textarea>
					</div>
				</div>

				<div class="wrap-btn-booking flex-c-m m-t-13">
					<!-- Button3 -->
					<button type="submit" class="btn3 flex-c-m size36 txt11 trans-0-4">
						Enviar
					</button>
				</div>
			</form>		
		</div> --}}
	</section>

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>


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

	<!--Mapa-->
	<script src="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.js"></script>
	<script>
		mapboxgl.accessToken = 'pk.eyJ1IjoiamFzZW5iZXJtIiwiYSI6ImNqeXhpZDFmbDA3a2YzY28xcW5kMWI3ajMifQ.CdmHunZbUBpmZPYvK0_HyA';
	
		var geojson = <?php echo json_encode($markers,JSON_NUMERIC_CHECK); ?>;
		

		var map = new mapboxgl.Map({
			container: 'map-canvas', // container id
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [-79.8862076, -2.1961601], // starting position
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
		geojson.features.forEach(function(marker) {
		let element = document.createElement('div');
		element.className = 'marker';
			
		new mapboxgl.Marker(element)
			.setLngLat(marker.geometry.coordinates)
			.setPopup(new mapboxgl.Popup({ offset:25 })
			.setHTML('<h3>' + marker.properties.name + '</h3> <p>' + marker.properties.location + '</p>'))
			.addTo(map);	
		// map.on('click', e => {		
		// 	if (e.lngLat === marker.geometry.coordinates) {
		// 		console.log(e.lngLat);
		// 		console.log('paso');
		// 	}
		// 	new mapboxgl.Popup(element).setLngLat(marker.geometry.coordinates).setHTML('<h1>ejemplo</h1>').addTo(map);
		// });	
		
		});

		
		

		
	</script>
    <!--Fin mapa-->

</body>
</html>
