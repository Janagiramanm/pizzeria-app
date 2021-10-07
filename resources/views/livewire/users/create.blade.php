      <h2 class="font-semibold text-xl text-gray-800 leading-tight my-6 ml-10">
          @if($createMode)  {{ __('Add New User') }}
          @elseif($updateMode) {{ __('Edit User') }}
          @endif
      </h2>
      <br>
     
      
      <x-jet-secondary-button wire:click="view()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 -my-20">
           Customers
      </x-jet-button>

      <form  class="w-full max-w-6xl ml-10 mr-10">

            <div class="flex">
                  <div class="md:w-1/2 m-2"> 
                           <x-jet-label for="role" value="{{ __('Role') }}" />
                            <select id="role" wire:model="role"  class="block mt-1 w-4/5 p-2  bg-gray-200" name="role">
                              <option value="">Select Role</option>
                              @foreach ($roles as $role)
                                          <option value="{{ $role->id }}">
                                                {{ ucfirst($role->name) }}
                                          </option>
                              @endforeach

                           </select>
                             @error('role') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
                  <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="name" value="{{ __('Full Name') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="name" type="text" placeholder="" wire:model="name">
                             @error('name') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 

            </div>
            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="mobile" value="{{ __('Mobile') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="mobile" type="text" placeholder="" wire:model="mobile">
                             @error('mobile') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="email" type="text" placeholder="" wire:model="email">
                             @error('email') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
            </div>
            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="imei" value="{{ __('IMEI') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="imei" type="text" placeholder="" wire:model="imei">
                             @error('imei') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="city" value="{{ __('City') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="city" type="text" placeholder="" wire:model="city">
                             @error('city') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
            </div>
            <div class="flex">
                  <div class="md:w-1/2 m-2 mr-3"> 
                            <x-jet-label for="address" value="{{ __('Address') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="address" type="text" placeholder="" wire:model="address">
                             @error('address') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
            </div>
            <div class="flex">
                  <div class="w-full bg-red-200 m-2 mr-28 h-100"> 
                        <div id="map">
                                   
                        </div>
                        <pre id="coordinates" class="coordinates"></pre> 
                 </div>
            </div>
            @if($createMode)
                  <x-jet-button wire:click.prevent="store()" class="bg-orange-500 hover:bg-orange-700 ml-2">
                        Save
                  </x-jet-button>
            @elseif($updateMode)
                  <x-jet-button wire:click.prevent="update()" class="bg-orange-500 hover:bg-orange-700 ml-2">
                        Update
                  </x-jet-button>
            @endif
           
             
      </form>
      

      <style>
            #map{
                  height: 300px;
                  /* background:red; */
            
            }
      </style>
 <script>
                                          mapboxgl.accessToken = 'AIzaSyB9G5CsqGsNlwFR7rIG9qyEJYDTi3yckjI';
                                          // mapboxgl.accessToken = 'pk.eyJ1IjoiamFuYWdpcmFtYW4yMSIsImEiOiJja3R6a2xnc24xeTMzMnNxbnIza3RmbnZqIn0.VUWwcy5DHVNeXq3CwAPnfg';
                                    const coordinates = document.getElementById('coordinates');
                                    const map = new mapboxgl.Map({
                                          container: 'map',
                                          style: 'mapbox://styles/mapbox/streets-v11',
                                          center: [0,0],
                                          zoom: 2,
                                          bbox: [-122.30937, 37.84214, -122.23715, 37.89838],
                                    });

                                    const marker = new mapboxgl.Marker({
                                          draggable: true
                                    })
                                          .setLngLat([0, 0])
                                          .addTo(map);

                                    function onDragEnd() {
                                          const lngLat = marker.getLngLat();
                                          coordinates.style.display = 'block';
                                          coordinates.innerHTML = `Longitude: ${lngLat.lng}<br />Latitude: ${lngLat.lat}`;
                                    }

                                    marker.on('dragend', onDragEnd);
                                    </script>
     
        