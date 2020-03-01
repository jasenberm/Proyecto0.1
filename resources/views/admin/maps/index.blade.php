@extends('layouts.app')

@section('title', 'Mapa')

@push('css')    
    <style>
        #map { 
          margin-top: 0%;
          height: 500px; 
          border-radius: 20px;
        }        
    </style> 

    <link href="https://api.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css" type="text/css"/>

@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <div id="map"></div>
              </div> 
              <div class="col-md-6">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur amet officiis tenetur commodi omnis, ea architecto recusandae placeat facilis praesentium doloremque culpa ratione voluptas? Officiis quod laborum esse dignissimos animi?</p>
                  <h1>Una vez "Marcada" su posicion pulse guardar</h1>
              <div id='coordinates' class='coordinates'></div>
              <button type="submit" id="guardarCoordenadas">Guardar</button>
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
      coordinates.style.display = 'block';
      coordinates.innerHTML =
      "<label id='lgn'>" + lngLat.lng + "</label><label id='lat'>" + lngLat.lat + "</label>"      
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

  $('#guardarCoordenadas').click(function(){
    var lng = document.getElementById('lgn').textContent;
    var lat = document.getElementById('lat').textContent;

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
      }
    }); 
    $.ajax({
			type: "POST",
			url: "{{ route('restaurnat.coordinates') }}",
			data: {
        'lng' : lng,
        'lat' : lat
      },
			success: function(r){
        alert(r)
			}
		});
  	redirect 
});

</script>
@endpush