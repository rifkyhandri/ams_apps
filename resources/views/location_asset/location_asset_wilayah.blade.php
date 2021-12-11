@extends('layouts.dashboard')
@section('content')
@section('link')
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@stop
<div class="row">
    <div style="margin-bottom: 0.2rem;" class="col-12 grid-margin">
        <div style="height: 65px; border-radius: 15px;" class="card">
            <div class="card-body">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; height: 40px;">
                    <h4 class="card-title" style="font-size: 2rem; font-weight: 300; margin-bottom: 0px;">Location - Wilayah</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="map_canvas" style="width: 100%; height: 600px;"></div>
<script>

var map;

// Ban Jelačić Square - City Center
var center = new google.maps.LatLng(45.812897, 15.97706);

var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();

function init() {

var mapOptions = {
zoom: 13,
center: center,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
var url = '/location_wilayah_json';
map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

makeRequest(url, function(data) {

var data = JSON.parse(data.responseText);

for (var i = 0; i < data.length; i++) {
displayLocation(data[i]);
}
});
}
    </script>

@endsection