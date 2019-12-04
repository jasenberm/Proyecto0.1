@extends('layouts.app')

@section('title', 'Mapa')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.css">
    <style>
        #map { height: 380px; }
    </style>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur amet officiis tenetur commodi omnis, ea architecto recusandae placeat facilis praesentium doloremque culpa ratione voluptas? Officiis quod laborum esse dignissimos animi?</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="map"></div>
                </div>    
            </div>
            <div class="row">
              <div class="col">
                <h1>Una vez "Marcada" su posicion pulse guardar</h1>
                <pre id='coordinates' class='coordinates'></pre>
                <button type="submit">Guardar</button>
              </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

    <script src="https://unpkg.com/esri-leaflet@2.3.0/dist/esri-leaflet.js"></script>

    <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.js"></script></script>

    <script>
      const guayaquil = [-2.1961601, -79.8862076];

      const mymap = L.map('map',{
        center: guayaquil,
        zoom: 14,
        scrollWheelZoom:false,
      });

      var Vicon = "img/bu-chibi-dragon-ball-z.png";
      var marker = L.icon({
          iconUrl: Vicon,
          iconSize:     [38, 95], 
          shadowSize:   [50, 64],
      }); 

      L.tileLayer('https://api.mapbox.com/styles/v1/jasenberm/cjyxp1dur32kg1cnt7o7svagf/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiamFzZW5iZXJtIiwiYSI6ImNqeXhpZDFmbDA3a2YzY28xcW5kMWI3ajMifQ.CdmHunZbUBpmZPYvK0_HyA', {
        maxZoom: 20,
        attribution:
      '<a href="https://www.mapbox.com/about/maps/" target="_blank">© Mapbox</a>'+
      '<a href="http://www.openstreetmap.org/about/" target="_blank">© OpenStreetMap</a>',
      }).addTo(mymap);

      const searchControl = L.esri.Geocoding.geosearch({placeholder: 'Busque una referencia', useMapBounds: false}).addTo(mymap);   
      var results = L.layerGroup().addTo(mymap); 

      searchControl.on('results', onResults)

      function onResults(data){
        results.clearLayers();
        for (var i = data.results.length - 1; i >= 0; i--) {
          console.log(data.results[i].latlng);
          var Lmarker = L.marker(data.results[i].latlng, {draggable: true, icon: marker});
          coordinates.style.display = 'block';
          coordinates.innerHTML = 'Longitude: ' + data.results[i].latlng.lng + '<br />Latitude: ' + data.results[i].latlng.lat;
        
          Lmarker.on('dragend', onDragEnd);
        
          results.addLayer(Lmarker);
        }
      }

      function onDragEnd(e){
        var lngLat = e.target.getLatLng();
        coordinates.style.display = 'block';
        coordinates.innerHTML = 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
      }

    </script>

@endpush