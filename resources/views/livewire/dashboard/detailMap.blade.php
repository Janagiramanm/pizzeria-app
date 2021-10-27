

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
<div class="flex">
        <div   class="w-full mt-2 mr-1 ml-1 "> 
             
               <x-jet-secondary-button wire:click="back()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 my-6">
                                        Back
                </x-jet-button>
                <div class="w-full " id="detail-map"></div>
                <div id="infowindow-detail">
                        <span id="place-name" class="title"></span><br />
                        <span id="place-address"></span>
                </div>    
         
        </div>
      
<style>
      #detail-map{
            height: 600px; 
            width: 100%; 
      }
</style> 
<script>
  $('document').ready(function(){

    
         
    detailMap();
    function detailMap() {
      
    var lt =  11.0168;
    var ln = 76.9558;
    // var locations = @php echo $this->latLong;  @endphp;
   
    var mapProp = {
      center: new google.maps.LatLng(11.0168, 76.9558),
      zoom: 5,
    };
    var map = new google.maps.Map(document.getElementById("detail-map"), mapProp);

    
    var goldenGatePosition = @php echo $this->reslatLong;  @endphp;
   
    var bounds = new google.maps.LatLngBounds();
    var lastplace = goldenGatePosition.length - 1 ;
    var distance =  getDistanceFromLatLonInKm(goldenGatePosition[0].lat,goldenGatePosition[0].lng,goldenGatePosition[lastplace].lat,goldenGatePosition[lastplace].lng);
    for (let i = 0; i < goldenGatePosition.length; i++) {
      var marker = new google.maps.Marker({ 
        position: goldenGatePosition[i],
        map: map,
        title: goldenGatePosition[i].lat+', '+goldenGatePosition[i].lng
        // title: 'Golden Gate Bridge'+' distance '+distance+' length '+lastplace
      });

      // var marker = new google.maps.Marker({
      //   position: goldenGatePosition[lastplace],
      //   map: map,
      //   // title: 'Golden Gate Bridge'
      //   title:  title: goldenGatePosition[lastplace].lat+', '+goldenGatePosition[lastplace].lng
      // });
      
      bounds.extend(goldenGatePosition[i]);
    }
    var flightPath = new google.maps.Polyline({
      path: goldenGatePosition,
      geodesic: true,
      strokeColor: "#0000FF",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
    });
    flightPath.setMap(map);
    map.fitBounds(bounds);

    var infowindow = new google.maps.InfoWindow();
    var codeStr = ''
    // google.maps.event.addListener(flightPath, 'click', function(event) {
    //   // make polyline for each segment of the input line
    //   for (var i = 0; i < this.getPath().getLength() - 1; i++) {
    //     var segmentPolyline = new google.maps.Polyline({
    //       path: [this.getPath().getAt(i), this.getPath().getAt(i + 1)]
    //     });
    //     // check to see if the clicked point is along that segment
    //     if (google.maps.geometry.poly.isLocationOnEdge(event.latLng, segmentPolyline, 10e-3)) {
    //       // output the segment number and endpoints in the InfoWindow
    //       var content = "segment " + i + "<br>";
    //       content += "start of segment=" + segmentPolyline.getPath().getAt(0).toUrlValue(6) + "<br>";
    //       content += "end of segment=" + segmentPolyline.getPath().getAt(1).toUrlValue(6) + "<br>";
    //       infowindow.setContent(content);
    //       infowindow.setPosition(event.latLng);
    //       infowindow.open(map);
    //     }
    //   }
    // });
    }
  

  // var directionsDisplay;
  // var directionsService = new google.maps.DirectionsService();
  // var map;

  // function initialize() {
  //   directionsDisplay = new google.maps.DirectionsRenderer();
  //   var myOptions = {
  //     mapTypeId: google.maps.MapTypeId.ROADMAP,
  //   }
  //   map = new google.maps.Map(document.getElementById("detail-map"), myOptions);
  //   directionsDisplay.setMap(map);

  //   var start = '13.0212285, 77.6473192';
  //   var end = '13.0435372, 77.5465994';
  //   var locations = @php echo $this->latLong;  @endphp;
  //   var waypts = [];
  //   var wayPoints = @php echo $this->wayPoints;  @endphp;

  //   //console.log(wayPoints);
  //   for (let i = 0; i < wayPoints.length; i++) {
  //       waypts.push({
  //           location: wayPoints[i],
  //           stopover: true
  //       });
  //   }

  //   //console.log(waypts);
    
  //   var request = {
  //     origin:start, 
  //     destination:end,
  //     // waypoints: waypts,
  //     // optimizeWaypoints: true,
  //     travelMode: google.maps.DirectionsTravelMode.DRIVING
  //   };
  //   directionsService.route(request, function(response, status) {
      
  //     if (status == google.maps.DirectionsStatus.OK) {
  //       directionsDisplay.setDirections(locations);
  //       // var myRoute = response.routes[0];
  //       // var txtDir = '';
  //       // for (var i=0; i<myRoute.legs[0].steps.length; i++) {
  //       //   txtDir += myRoute.legs[0].steps[i].instructions+"<br />";
  //       // }
  //       // document.getElementById('directions').innerHTML = txtDir;
  //     }
  //   });
  // }

  // initialize(); 


  /* initMap();
  function initMap() {
    var service = new google.maps.DirectionsService;
    var map = new google.maps.Map(document.getElementById('detail-map'));
    window.gMap = map;

    // list of points
    // var stations = [
    //     {lat: 48.9812840, lng: 21.2171920, name: 'Station 1'},
    //     {lat: 48.9832841, lng: 21.2176398, name: 'Station 2'},
    //     {lat: 48.9856443, lng: 21.2209088, name: 'Station 3'},
    //     {lat: 48.9861461, lng: 21.2261563, name: 'Station 4'},
    //     {lat: 48.9874682, lng: 21.2294855, name: 'Station 5'},
    //     {lat: 48.9909244, lng: 21.2295512, name: 'Station 6'},
    //     {lat: 48.9928871, lng: 21.2292352, name: 'Station 7'},
    //     {lat: 48.9921334, lng: 21.2246742, name: 'Station 8'},
    //     {lat: 48.9943196, lng: 21.2234792, name: 'Station 9'},
    //     {lat: 48.9966345, lng: 21.2221262, name: 'Station 10'},
    //     {lat: 48.9981191, lng: 21.2271386, name: 'Station 11'},
    //     {lat: 49.0009168, lng: 21.2359527, name: 'Station 12'},
    //     {lat: 49.0017950, lng: 21.2392890, name: 'Station 13'},
    //     {lat: 48.9991912, lng: 21.2398272, name: 'Station 14'},
    //     {lat: 48.9959850, lng: 21.2418410, name: 'Station 15'},
    //     {lat: 48.9931772, lng: 21.2453901, name: 'Station 16'},
    //     {lat: 48.9963512, lng: 21.2525850, name: 'Station 17'},
    //     {lat: 48.9985134, lng: 21.2508423, name: 'Station 18'},
    //     {lat: 49.0085000, lng: 21.2508000, name: 'Station 19'},
    //     {lat: 49.0093000, lng: 21.2528000, name: 'Station 20'},
    //     {lat: 49.0103000, lng: 21.2560000, name: 'Station 21'},
    //     {lat: 49.0112000, lng: 21.2590000, name: 'Station 22'},
    //     {lat: 49.0124000, lng: 21.2620000, name: 'Station 23'},
    //     {lat: 49.0135000, lng: 21.2650000, name: 'Station 24'},
    //     {lat: 49.0149000, lng: 21.2680000, name: 'Station 25'},
    //     {lat: 49.0171000, lng: 21.2710000, name: 'Station 26'},
    //     {lat: 49.0198000, lng: 21.2740000, name: 'Station 27'},
    //     {lat: 49.0305000, lng: 21.3000000, name: 'Station 28'},
    //     // ... as many other stations as you need
    // ];

     var stations = @php echo $this->reslatLong;  @endphp;
    

    // Zoom and center map automatically by stations (each station will be in visible map area)
    var lngs = stations.map(function(station) { return station.lng; });
    var lats = stations.map(function(station) { return station.lat; });
    map.fitBounds({
        west: Math.min.apply(null, lngs),
        east: Math.max.apply(null, lngs),
        north: Math.min.apply(null, lats),
        south: Math.max.apply(null, lats),
    });

    // Show stations on the map as markers
   
    var lastMarker = stations.length -1 ;
    var distance =  getDistanceFromLatLonInKm(stations[0].lat,stations[0].lng,stations[lastMarker].lat,stations[lastMarker].lng);
    var travelKm =  parseFloat(distance.toFixed(2)); 
   
    for (var i = 0; i <= stations.length; i++) {
      var smarker =  new google.maps.Marker({
            position: stations[0],
            map: map            
        });
      var emarker = new google.maps.Marker({
                  position: stations[lastMarker],
                  map: map
            });
       var sinfowindow = new google.maps.InfoWindow({
            content: stations[0].detail,
            size: new google.maps.Size(150, 50)
       });
       var einfowindow = new google.maps.InfoWindow({
            content: stations[lastMarker].detail+'<br>Distance:'+travelKm+' km',
            size: new google.maps.Size(150, 50)
       });
       google.maps.event.addListener(smarker, 'mouseover', function() {
                         einfowindow.open(map, smarker);
       });
       google.maps.event.addListener(emarker, 'mouseover', function() {
                         einfowindow.open(map, emarker);
       });
        
         
    }

    // Divide route to several parts because max stations limit is 25 (23 waypoints + 1 origin + 1 destination)
    for (var i = 0, parts = [], max = 25 - 1; i < stations.length; i = i + max)
        parts.push(stations.slice(i, i + max + 1));

    // Service callback to process service results
    var service_callback = function(response, status) {
        if (status != 'OK') {
            console.log('Directions request failed due to ' + status);
            return;
        }
        var renderer = new google.maps.DirectionsRenderer;
        if (!window.gRenderers)
        		window.gRenderers = [];
        window.gRenderers.push(renderer);
        renderer.setMap(map);
        renderer.setOptions({ suppressMarkers: true, preserveViewport: true });
        renderer.setDirections(response);
    };

    // Send requests to service to get route (for stations count <= 25 only one request will be sent)
    for (var i = 0; i < parts.length; i++) {
        // Waypoints does not include first station (origin) and last station (destination)
        var waypoints = [];
        for (var j = 1; j < parts[i].length - 1; j++)
            waypoints.push({location: parts[i][j], stopover: false});
        // Service options
        var service_options = {
            origin: parts[i][0],
            destination: parts[i][parts[i].length - 1],
            waypoints: waypoints,
            travelMode: 'WALKING'
        };
        console.log(waypoints);
        // Send request
        service.route(service_options, service_callback);
    }
  }
*/
  function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
        var R = 6371; // Radius of the earth in km
        var dLat = deg2rad(lat2-lat1);  // deg2rad below
        var dLon = deg2rad(lon2-lon1); 
        var a = 
          Math.sin(dLat/2) * Math.sin(dLat/2) +
          Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
          Math.sin(dLon/2) * Math.sin(dLon/2)
          ; 
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        var d = R * c; // Distance in km
        return d;
      }
      
      function deg2rad(deg) {
        return deg * (Math.PI/180)
      }

});

   
</script>