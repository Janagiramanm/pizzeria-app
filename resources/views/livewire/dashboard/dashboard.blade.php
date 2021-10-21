

     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
  
</x-slot>


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
                
                var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 8,
                        center: new google.maps.LatLng(lt,ln),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                        });

                        var infowindow = new google.maps.InfoWindow();

                        var marker, i;

                        for (i = 0; i < locations.length; i++) {  
                        marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map
                        });

                        google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
                              //  var projection = overlay.getProjection(); 
                            // var pixel = projection.fromLatLngToContainerPixel(marker.getPosition());
                        return function() {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                               
                        }
                        })(marker, i));
                        }
           },500)
      
  });
   
</script>
@endpush    



