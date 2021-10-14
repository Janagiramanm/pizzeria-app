// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initMap() {
    const myLatlng = new google.maps.LatLng(12.972442,77.580643);
    const map = new google.maps.Map(document.getElementById("map"), {
      center: myLatlng,
      zoom: 13,
    });
    const input = document.getElementById("pac-input");
    const autocomplete = new google.maps.places.Autocomplete(input);
  
    autocomplete.bindTo("bounds", map);

    // Specify just the place data fields that you need.
    autocomplete.setFields(["place_id", "geometry", "name", "formatted_address"]);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  
    const infowindow = new google.maps.InfoWindow();
    const infowindowContent = document.getElementById("infowindow-content");
  
    infowindow.setContent(infowindowContent);
  
    var latitude = 23.786758526804636;
    var longitude = 90.39979934692383;
    var LatLng = new google.maps.LatLng(latitude, longitude);

    const geocoder = new google.maps.Geocoder();
    const marker = new google.maps.Marker({ 
      draggable: true,
       map: map ,
      });
      google.maps.event.addListener(marker, 'dragend', function(e) {
        displayPosition(this.getPosition());
      });
        
    marker.addListener("click", () => {
      infowindow.open(map, marker);
    });

    autocomplete.addListener("place_changed", () => {
      infowindow.close();
  
      const place = autocomplete.getPlace();
  
      if (!place.place_id) {
        return;
      }
  
      geocoder
        .geocode({ placeId: place.place_id })
        .then(({ results }) => {
          map.setZoom(16);
          map.setCenter(results[0].geometry.location);
         
          document.getElementById('address-div').style.display ='block'; 
          document.getElementById('address-div1').style.display ='block'; 
          document.getElementById('address-section').innerHTML = results[0].formatted_address;
          document.getElementById('lat-section').innerHTML = results[0].geometry.location.lat();
          document.getElementById('lng-section').innerHTML = results[0].geometry.location.lng();
        
         const marker = new google.maps.Marker({
            map: map,
            draggable: true,
            position: results[0].geometry.location
          });

          google.maps.event.addListener(marker, 'dragend', function() {

            geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
           
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                  
                  document.getElementById('pac-input').value = results[0].formatted_address;
                  document.getElementById('address-section').innerHTML = results[0].formatted_address;
                  document.getElementById('lat-section').innerHTML = results[0].geometry.location.lat();
                  document.getElementById('lng-section').innerHTML = results[0].geometry.location.lng();
                  infowindow.setContent(results[0].formatted_address);
                  infowindow.open(map, marker);
                  Livewire.emit('getLatLngForInput', results[0].formatted_address,results[0].geometry.location.lat(),results[0].geometry.location.lng());
                }
            }
            });
          });
          Livewire.emit('getLatLngForInput', results[0].formatted_address,results[0].geometry.location.lat(),results[0].geometry.location.lng());
          marker.setVisible(true);
          infowindowContent.children["place-name"].textContent = place.name;
          infowindowContent.children["place-address"].textContent =
            results[0].formatted_address;
                    
          infowindow.open(map, marker);
        })
        .catch((e) => window.alert("Geocoder failed due to: " + e));

    });

    
}
 


  
  