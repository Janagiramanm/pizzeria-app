// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initMap() {
  // alert('jj');
    const map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: -33.8688, lng: 151.2195 },
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
  
    const geocoder = new google.maps.Geocoder();
    const marker = new google.maps.Marker({ map: map , draggable: true});
  
    marker.addListener("click", () => {
      infowindow.open(map, marker);
    });

   
    // marker.addListener('drag', (event) => handleMarkerDrag(event));
    autocomplete.addListener("place_changed", () => {
      infowindow.close();
  
      const place = autocomplete.getPlace();
  
      if (!place.place_id) {
        return;
      }
  
      geocoder
        .geocode({ placeId: place.place_id })
        .then(({ results }) => {
          map.setZoom(11);
          map.setCenter(results[0].geometry.location);
          // Set the position of the marker using the place ID and location.
          marker.setPlace({
            placeId: place.place_id,
            location: results[0].geometry.location
          });
          document.getElementById('address-div').style.display ='block'; 
          document.getElementById('address-div1').style.display ='block'; 
          document.getElementById('address-section').innerHTML = results[0].formatted_address;
          document.getElementById('lat-section').innerHTML = results[0].geometry.location.lat();
          document.getElementById('lng-section').innerHTML = results[0].geometry.location.lng();
          document.getElementById('grid-address').value = results[0].formatted_address;
          document.getElementById('grid-latitude').value = results[0].geometry.location.lat();
          document.getElementById('grid-longitude').value = results[0].geometry.location.lng();
          marker.setVisible(true);
          infowindowContent.children["place-name"].textContent = place.name;
          //infowindowContent.children["place-id"].textContent = place.place_id;
          infowindowContent.children["place-address"].textContent =
            results[0].formatted_address;
                    
          infowindow.open(map, marker);
        })
        .catch((e) => window.alert("Geocoder failed due to: " + e));

    });

  //   google.maps.event.addListener(marker,'drag',function(event) {
  //     alert('ok');
  //     // document.getElementById('lat').value = event.latLng.lat();
  //     // document.getElementById('lng').value = event.latLng.lng();
  //     // var infowindow = new google.maps.InfoWindow({
  //     //     content: 'Latitude: ' + event.latLng.lat() + '<br>Longitude: ' + event.latLng.lng()
  //     //   });
  //     infowindow.open(map,marker);
  // });
  
  
  }


  
  