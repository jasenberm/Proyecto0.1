@extends('layouts.app')

@section('title', 'Category')

@push('css')
  <link href="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css" type="text/css"/>
  <style>
    #map { 
      margin-top: 0%;
      height: 310px;            
      border-radius: 20px;
    }        
  </style> 
@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Agregar Nuevo Restaurante</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('restaurant.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Tipo de Restaurante</label>
                            <select class="form-control custom-select browser-default" id="category" name="category" required>
                              <option value="">Seleccione el tipo de restaurante...</option>
                              @foreach ($categoryRestaurant as $categories)
                              <option value="{{ $categories->id }}"> {{ $categories->name }}</option>
                              @endforeach
                            </select>                            
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nombre del Restaurante</label>
                                <input type="text" class="form-control" id="name_restaurant" name="name_restaurant" value="{{ old('name_restaurant') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">RUC</label>
                              <input type="text" class="form-control" id="ruc" name="ruc" value="{{ old('ruc') }}">
                          </div>
                      </div>
                        <div class="col-md-12">
                          <div class="custom-file">
                              <label class="bmd-label-floating">Elegir una foto</label>
                              <input type="file" name="image">
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Descripción</label>
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                            </div>
                        </div>  
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Ubicación</label>
                              <input type="text" class="form-control" name="location" value="{{ old('location') }}">
                          </div>
                        </div>
                        <br>
                        <dd class="col-sm-9"><a href="#" data-toggle="modal" data-target="#modalMapa">Agregar en el mapa</a> la dirección de su restaurante para obtener los siguientes campos<br></dd>                                                
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Longitud</label>
                              <input type="text" readonly class="form-control" id="longitud" name="longitud" value="{{ old('longitud') }}">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Latitud</label>
                              <input type="text" readonly class="form-control" id="latitud" name="latitud" value="{{ old('latitud') }}">
                          </div>
                        </div>                        
                        <br>
                        <a href="{{ route('restaurant.index') }}" class="btn btn-danger">Retroceder</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
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
                        <p>Arrastre el puntero por el mapa hasta la ubicación de su restaurnate y pulse "Hecho!"</p>
                        <div id="map"></div>                                                                                               
                      </div>
                    </div>                  
                    <div class="modal-footer">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">Hecho!</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
  <script src="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.js"></script>
  <script src="{{ asset ('backend/js/bootstrap-validate.js') }}"></script>

  <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiamFzZW5iZXJtIiwiYSI6ImNqeXhpZDFmbDA3a2YzY28xcW5kMWI3ajMifQ.CdmHunZbUBpmZPYvK0_HyA';
    if (!mapboxgl.supported()) {
      alert('Your browser does not support Mapbox GL');
    } else {
      
      const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-79.8862076, -2.1961601],
        zoom: 14,
        scrollZoom: false
      });
  
      var marker = new mapboxgl.Marker({
        draggable: true
      })
      .setLngLat([-79.8862076, -2.1961601])
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
    };      
  
  </script>

  <script>    
    bootstrapValidate('#name_restaurant','required:El campo nombre es requerido');
    bootstrapValidate('#name_restaurant','max:28:El campo nombre no debe de contener mas de 28 caracteres');
    bootstrapValidate('#category','required:El campo nombre es requerido');
    bootstrapValidate('#ruc','numeric:Ingrese solamente digitos');
    bootstrapValidate('#ruc','max:13:No ingrese más de 13 digitos');
    bootstrapValidate('#ruc','min:13:No ingrese menos de 13 digitos');
  </script>
@endpush