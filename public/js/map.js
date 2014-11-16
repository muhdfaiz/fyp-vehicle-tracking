function googleMapInit()
{
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 18,
        //center: new google.maps.LatLng(sessionStorage.latitude, sessionStorage.longitude),
        center: new google.maps.LatLng(3.23486, 101.62984),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);
}

function googleMapInit1()
{
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 18,
        center: new google.maps.LatLng(3.23486, 101.62984),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
}

function moveToLocation(latitude, longitude){
    var center = new google.maps.LatLng(latitude, longitude);
    // using global variable:
    map.panTo(center);
}

// Add a marker to the map and push to the array.
function addMarker(latitude, longitude, googleMap, date, time) {
    var position = new google.maps.LatLng(latitude, longitude);
    marker = new google.maps.Marker({
        position: position,
        map: googleMap,
    });


    var contentString = "<div style='font-size:14px;width:180px; height:90px;'>" + "<span style='font-weight: bold;'>Latitude:</span> " + latitude + "<br /> <span style='font-weight: bold;'>Longitude:</span> "  + longitude + "<br /> <span style='font-weight: bold;'>Date:</span> " + date +  "<br /> <span style='font-weight: bold;'>Time:</span> " + time +'</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });
}

function removeMarker(marker) {
    marker.setMap(null);
}

function drawROute(path) {
    var routes= new google.maps.Polyline({
        path: path,
        geodesic: true,
        strokeColor: '#1bbc9b',
        strokeOpacity: 1.0,
        strokeWeight: 5,
        map: map
    });
}

function reverseGeocoding(latitude, longitude, speed, date, time, googleMap)
{
    var address;

    var latlng = new google.maps.LatLng(latitude, longitude);
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'latLng': latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[1]) {
                //sessionStorage.setItem("address",results[1].formatted_address);
                address = results[1].formatted_address;
                $('#address').text(address);
                var position = new google.maps.LatLng(latitude, longitude);
                marker = new google.maps.Marker({
                    position: position,
                    map: googleMap,
                    icon: '../public/images/marker.png'
                });


                var contentString = "<div id='mapMarker' style='font-size:14px;width:300px; height:140px;'>" + "<span id='addressContent' style='font-weight: bold;'>Address:</span> " + address + "<br /><span style='font-weight: bold;'>Speed:</span> " + speed + ' KM/Hour' + "<br /> <span style='font-weight: bold;'>Latitude:</span> " + latitude + "<br /> <span style='font-weight: bold;'>Longitude:</span> "  + longitude + "<br /> <span style='font-weight: bold;'>Date:</span> "  + date  + "<br /> <span style='font-weight: bold;'>Time:</span> "  + time + '</div>';
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                return address;
            } else {
                alert('No results found');
            }
        } else {
            alert('Geocoder failed due to: ' + status);
        }

    });
}

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
            break;
        }
    }
}