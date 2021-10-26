

     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
  
</x-slot>
@if($detailMap)
            @include('livewire.dashboard.detailMap')
@else

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
<div class="flex">
        <div   class="w-full mt-2 mr-1 ml-1 "> 
               
           
                <div class="w-full " id="map"></div>
                <div id="infowindow-content">
                        <span id="place-name" class="title"></span><br />
                        <span id="place-address"></span>
                </div>    
         
        </div>
      
<style>
      #map{
            height: 600px; 
            width: 100%; 
      }
</style> 
@push('scripts') 
<script>
  $('document').ready(function(){
          setTimeout(function(){
                var locations = @php echo $this->latLong;  @endphp;
                 var lt = @php echo $this->lat;  @endphp;
                 var ln = @php echo $this->lng;  @endphp;

                 const geocoder = new google.maps.Geocoder();
                 const apikey = "@php echo env('GOOGLEMAPAPI') @endphp";
                //const infowindow = new google.maps.InfoWindow();
               // var infowindow = [];
                var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 8,
                        center: new google.maps.LatLng(lt,ln),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                        });

                  

                        var marker, i; 
                       //var address=["madurai","chennai"];

                        for (i = 0; i < locations.length; i++) { 

                           
                               var details = locations[i][0];
                              
                               var user_id = locations[i][4];
                               var date = locations[i][5];

                               
                               $.get({ url: `https://maps.googleapis.com/maps/api/geocode/json?latlng=${locations[i][1]},${locations[i][2]}&sensor=false&key=${apikey}&udetails=${details}`, success(data) {
                               if (geocoder) {
                                              //console.log(data);
                                              const urlParams = new URLSearchParams(window.location.search);

                                              var udetails = urlParams.get('udetails');

                                             
                                                geocoder.geocode({
                                                'address': data.results[0].formatted_address,
                                                                                            
                                                }, function(results, status) {
                                                        if (status == google.maps.GeocoderStatus.OK) {
                                                                if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                                                                        map.setCenter(results[0].geometry.location);

                                                                        var infowindow = new google.maps.InfoWindow({
                                                                                content: details+'<br><b>' + results[0].formatted_address + '</b>',
                                                                                size: new google.maps.Size(150, 50)
                                                                        });

                                                                        var marker = new google.maps.Marker({
                                                                        position: results[0].geometry.location,
                                                                        map: map,
                                                                        content: details+ results[0].formatted_address
                                                                        });
                                                                        google.maps.event.addListener(marker, 'mouseover', function() {
                                                                               infowindow.open(map, marker);
                                                                        });

                                                                        google.maps.event.addListener(marker, 'mouseout', function() {
                                                                                        infowindow.close();
                                                                        });

                                                                          google.maps.event.addListener(marker, 'click', function(e) {
                                                                                Livewire.emit('getDetailPath',  user_id,date);
                                                                        });

                                                                } else {
                                                                alert("No results found");
                                                                }
                                                        } else {
                                                                alert("Geocode was not successful for the following reason: " + status);
                                                        }
                                                });
                                }
                               
                        }});

                        
                       
                        }
           },500)
      
                        
  });

   
</script>
@endpush  
@endif 


  



