

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
                var locations = @php echo $this->latLong;  @endphp

        //        var locations = [
        //               ["Janagiraman",19.009883,77.9988899,0],
        //               ["Muhesh",19.997883,77.9987899,1],
        //               ["Muhesh",19.165883,77.1985899,2],
        //               ["Janagiraman",19.129883,77.9988899,3]
        //           ];
               console.log(locations);
                var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 10,
                        center: new google.maps.LatLng(locations[0][1],locations[0][2]),
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



