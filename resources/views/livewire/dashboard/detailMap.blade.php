

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
<div class="flex">
        <div   class="w-full mt-2 mr-1 ml-1 "> 
               Detail Path
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

   var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;

  function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var myOptions = {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    }
    map = new google.maps.Map(document.getElementById("detail-map"), myOptions);
    directionsDisplay.setMap(map);

    var start = '13.0212285, 77.6473192';
    var end = '13.0435372, 77.5465994';
    var request = {
      origin:start, 
      destination:end,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      console.log(response);
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        var myRoute = response.routes[0];
        var txtDir = '';
        for (var i=0; i<myRoute.legs[0].steps.length; i++) {
          txtDir += myRoute.legs[0].steps[i].instructions+"<br />";
        }
        document.getElementById('directions').innerHTML = txtDir;
      }
    });
  }

  initialize();


});

   
</script>