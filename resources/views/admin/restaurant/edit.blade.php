@extends('layouts.app')

@section('title', 'Category')

@push('css')
  <link href="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css" type="text/css"/>
@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Editar Restaurante</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('restaurant.update', $restaurant->id) }}" enctype="multipart/form-data" autocomplete="off">
                      @csrf
                      @method('PUT')
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Categoria</label>
                          <select class="form-control" name="category">
                            <option selected>Seleccione la categoria...</option>
                            @foreach ($categoryRestaurant as $categories)
                            <option {{ $categories->id == $restaurant->category_restaurant->id? 'selected' : '' }} value="{{ $categories->id }}"> {{ $categories->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nombre</label>
                          <input type="text" class="form-control" id="name_restaurant" value="{{ $restaurant->name_restaurant }}" name="name_restaurant">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">RUC</label>
                          <input type="text" class="form-control" id="ruc" value="{{ $restaurant->ruc }}" name="ruc">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="custom-file">
                          <label class="bmd-label-floating">Elegir una foto</label>
                          <input type="file" class="form-control" name="image">
                        </div>
                      </div>   
                      <br>                     
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Descripción</label>
                          <textarea class="form-control" name="description">{{ $restaurant->description }}</textarea>
                        </div>
                      </div> 
                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Ubicación</label>
                            <input type="text" class="form-control" name="location" value="{{ $restaurant->location }}">
                        </div>
                      </div>
                      <br>
                      <div class="col-md-12">
                        <label class="bmd-label-floating">Redes Sociales</label>
                        <div class="row">                            
                          <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Facebook</label>
                                <input type="text" class="form-control" name="face" value="{{ $restaurant->facebook }}">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Instagram</label>
                                <input type="text" class="form-control" name="insta" value="{{ $restaurant->instagram }}">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">Twiter</label>
                                <input type="text" class="form-control" name="twit" value="{{ $restaurant->twiter }}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
                        <dd class="col-sm-9"><a href="#" data-toggle="modal" data-target="#modalMapa">Modificar en el mapa</a> la dirección de su restaurante<br></dd>                                                
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Longitud</label>
                              <input type="text" readonly class="form-control" id="longitud" name="longitud" value="{{ $restaurant->lng }}">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Latitud</label>
                              <input type="text" readonly class="form-control" id="latitud" name="latitud" value="{{ $restaurant->lat }}">
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
                      <h5 class="modal-title" id="modalImagenLbel">Cambiar la ubicacion de su restaurnate.</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">   
                      <div class="container">                        
                        <p>Arrastre el puntero por el mapa hasta la ubicación de su restaurnate y pulse "Hecho!"</p>
                        <div id="map" style="margin-top: 0%; height: 310px; width: 100%; border-radius: 20px;"></div>                                                                                               
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
    var lng = {{ $restaurant->lng }};
    var lat = {{ $restaurant->lat }};

    const map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [lng, lat],
      zoom: 14,
      scrollZoom: false
    });

    var lng = {{ $restaurant->lng }};
    var lat = {{ $restaurant->lat }};

    var marker = new mapboxgl.Marker({
      draggable: true
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