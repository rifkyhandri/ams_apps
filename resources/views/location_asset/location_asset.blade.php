@extends('layouts.dashboard')
@section('content')
@section('link')
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
@stop
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; " class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h1 class="card-title" style="font-size: 30px;"><span  style="font-size: 30px;font-family:'Oswald', sans-serif;color: black">{{$location->location_sm->location_sub->locationname_sub}} - </span>{{$location->location_sm->locationname_sm}}</h1>
                    <a href="https://www.google.co.id/maps/place/{{$location->gps_lat}},{{$location->gps_long}}" target="_blank" class="btn btn-primary btn-sm " style="margin: -0.2rem .05rem -1rem auto;" type="button" class="btn btn-primary btn-sm"><i class="ti-map-alt"></i>&ensp;Google Maps</a>
                </div>
            </div>
        </div>
    </div>
</div>
<body onload="initialize()">
  <div class="card">
  <div class="row">
      <div class="col-xl-8">
          <div id="map_canvas" class="" style="width: 100%; height: 600px;box-shadow: 10px 0px 8px grey;"></div>
      </div>
      <div class="col-xl-4">
          <h3 class="font-weight-bold text-dark mt-3" style="font-size: 30px;font-family:'Oswald', sans-serif;color: black">Location Info</h3>
          <form>
            <div class="form-group">
              <label for="Locationname">Location Name</label>
              <input type="text" class="form-control col-11" id="exampleInputEmail1" placeholder="Location Name" value="{{$location->location_sm->location_sub->locationname_sub}}">
            </div>
            
            <div class="form-group">
              <label for="contact">Ruangan</label>
              <input type="text" class="form-control col-11" id="exampleInputEmail1" placeholder="Contact" value="{{$location->location_sm->locationname_sm}}">
            </div>

            <div class="form-group">
              <label for="contact">Contact</label>
              <input type="text" class="form-control col-11" id="exampleInputEmail1" placeholder="Contact" value="{{$location->location_sm->contact}}">
            </div>
            
            <div class="form-group">
              <label for="contact">No.Telp</label>
              <input type="text" class="form-control col-11" id="exampleInputEmail1" placeholder="Contact" value="{{$location->location_sm->phone}}">
            </div>

            <div class="form-group">
              <label for="contact">Detail Location</label>
              <input type="text" class="form-control col-11" id="exampleInputEmail1" placeholder="Contact" value="{{$location->location_sm->address_sm}}">
            </div>
           


          </form>
      </div>
  </div>
</div>
  
</body>
<script>

   function initialize() {
  
  var loc = {!!  json_encode($location) !!};
  var locations = [
    [loc.location, loc.gps_lat,loc.gps_long]
  ];
  var infowindow = new google.maps.InfoWindow();
 
  var options = {
    zoom: 15, 
    center: new google.maps.LatLng(loc.gps_lat,loc.gps_long),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
 
    // Pembuatan petanya
  var map = new google.maps.Map(document.getElementById('map_canvas'), options);
 
    var marker, i;
 // proses penambahan marker pada masing-masing lokasi yang berbeda
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
   
      });
   
   // Menampilkan informasi pada masing-masing marker yang diklik 
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  
  };
    </script>

@endsection