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
                           <x-jet-label for="role" value="{{ __('Role') }} " /> 
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
                            <x-jet-label for="name" value="{{ __('Designation') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="designation" type="text" placeholder="" wire:model="designation">
                             @error('designation') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                  </div>

            </div>
            <div class="flex">
                  <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="emp_code" value="{{ __('Emp Code') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="emp_code" type="text" placeholder="" wire:model="emp_code">
                             @error('designation') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
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
                            <x-jet-label for="city_id" value="{{ __('City') }}" />
                            <select id="city_id" wire:model="city_id"  class="block mt-1 w-4/5 p-2  bg-gray-200" name="city_id">
                              <option value="">Select City</option>
                              @foreach ($cities as $city)
                                          <option value="{{ $city->id }}">
                                                {{ ucfirst($city->name) }}
                                          </option>
                              @endforeach

                           </select>
                           
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

                 <div class="md:w-1/2  m-2 mr-3">
                                <x-jet-label for="address" value="{{ __('Date of Joining') }}" />
                                <x-datepicker wire:model="date_of_join" id="date" :error="'date'" name="date_of_join" />
                                <br>
                                @error('date_of_join') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                  </div>
            </div>
            <div class="flex">
                  <div class="w-full bg-red-200 m-2 mr-28 h-100"> 
                        <div id="map">
                                   
                        </div>
                        <pre id="coordinates" class="coordinates"></pre> 
                 </div>
            </div>

            <div class="flex w-full">
                  <h2 class="font-semibold ml-1 mt-5 mb-5">Pay Details</h2>
            </div>
            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="basic_pay" value="{{ __('Basic Pay') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-basic-pay" 
                              name="basic_pay" type="text" placeholder="" wire:model="basic_pay">
                             @error('basic_pay') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="hra" value="{{ __('HRA') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-hra" 
                              name="hra" type="text" placeholder="" wire:model="hra">
                             @error('hra') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
            </div>
            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="conveyance" value="{{ __('Conveyance') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-conveyance" 
                              name="conveyance" type="text" placeholder="" wire:model="conveyance">
                             @error('conveyance') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="gratuity_pay" value="{{ __('Gratuity Pay') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-gratuity_pay" 
                              name="gratuity_pay" type="text" placeholder="" wire:model="gratuity_pay">
                             @error('gratuity_pay') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
            </div>
            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="special_allowance" value="{{ __('Special Allowance') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-special_allowance" 
                              name="special_allowance" type="text" placeholder="" wire:model="special_allowance">
                             @error('special_allowance') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="variable_incentive" value="{{ __('Variable Incentive') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-variable_incentive" 
                              name="variable_incentive" type="text" placeholder="" wire:model="variable_incentive">
                             @error('variable_incentive') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
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
      


 
     
        