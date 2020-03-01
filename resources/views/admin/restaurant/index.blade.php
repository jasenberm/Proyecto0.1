@extends('layouts.app')

@section('title', 'Restaurant')

@push('css')
  <link href="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css" type="text/css"/>
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      @if ($restaurants->isNotEmpty())
      @foreach ($restaurants as $restaurant)
        <a href="{{ route('restaurant.edit', $restaurant->id) }}" class="btn btn-primary">Modificar Informacion</a>  
        @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Informacion de mi Restaurante</h4>
          </div>
          {{-- @foreach ($restaurants as $restaurant)     --}}
          <div class="card-body">
            <div class="col-12">
              <dl class="row">
                <dt class="col-sm-3">Nombre de mi restaurante </dt>
                <dd class="col-sm-9">{{ $restaurant->name_restaurant }}<br></dd>

                <dt class="col-sm-3">Foto de mi restaurante </dt>
                <dd class="col-sm-9"><a href="#" data-toggle="modal" data-target="#modalImagen">{{ $restaurant->image }}</a><br></dd>
                
                <dt class="col-sm-3">Categoria</dt>
                <dd class="col-sm-9">{{ $categoryRestaurant->name }}<br></dd>
        
                <dt class="col-sm-3">Descripción</dt>
                <dd class="col-sm-9">{{ $restaurant->description }}<br></dd>
                
                <dt class="col-sm-3">Dirección</dt>
                <dd class="col-sm-9">{{ $restaurant->location }}<br></dd>                
                
                <dd class="col-sm-9"><a href="#" data-toggle="modal" data-target="#modalMapa">ver su ubicación</a> en el mapa<br></dd>
              </dl>
            </div>
          </div>
          <div class="modal fade" id="modalImagen" tabindex="-1" role="dialog" aria-labelledby="modalImagenLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalImagenLbel">{{ $restaurant->image }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <img src="{{ asset('upload/restaurant/'.$restaurant->image) }}" alt="restaurante"
                  style="width:100%">
                </div>
                <div class="modal-footer">
                  <h3>{{ $restaurant->name_restaurant }}</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modalMapa" tabindex="-1" role="dialog" aria-labelledby="modalMapaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalImagenLbel">Selecione su ubicacion en el mapa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">   
                  <div class="container">
                    <div id="map" style="margin-top: 0%; height: 310px; width: 100%; border-radius: 20px;"></div>                                                                                               
                  </div>
                </div>                  
                <div class="modal-footer">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">Volver</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
          {{-- @endforeach --}}
        </div>
      @endforeach
      @else
        <p><a href="{{ route('restaurant.create') }}" class="btn btn-primary">Agregar</a> el restaurante para proceder con la 
          creación de las categorias y productos que su negocio va a proveer.</p>
      @endif      
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.js"></script>

@if ($restaurants->isNotEmpty())
<script>
  mapboxgl.accessToken = 'pk.eyJ1IjoiamFzZW5iZXJtIiwiYSI6ImNqeXhpZDFmbDA3a2YzY28xcW5kMWI3ajMifQ.CdmHunZbUBpmZPYvK0_HyA';
  if (!mapboxgl.supported()) {
    alert('Your browser does not support Mapbox GL');
  } else {   
     var lng = {{ $restaurant->lng }};
     var lat = {{ $restaurant->lat }};
      const map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [lng, lat],
      zoom: 14,
      scrollZoom: false
    });

    var marker = new mapboxgl.Marker({
      draggable: false
    })
    .setLngLat([lng, lat])
    .addTo(map);
    
    function onDragEnd() {
      var lngLat = marker.getLngLat();
      $('#longitud').val(lngLat.lng);
      $('#latitud').val(lngLat.lat);            
    }
    
    marker.on('dragend', onDragEnd);

    // Add zoom and rotation controls to the map.
    map.addControl(new mapboxgl.NavigationControl());
    
    // Agregar geolocalizacion
    map.addControl(
      new mapboxgl.GeolocateControl({
        positionOptions: {
          enableHighAccuracy: true
        },
        trackUserLocation: true,
        fitBoundsOptions: {
          zoom:14
        }
      })
    );
  }
    

         

</script>
@endif

@endpush