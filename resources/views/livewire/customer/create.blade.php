
        <h2 class="font-semibold text-xl text-gray-800 leading-tight my-6">
            {{ __('Add New Customer') }}
        </h2>
        <br>
        <x-jet-secondary-button wire:click="view()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 -my-20">
           Customers
        </x-jet-button>
        
        <div>
        <form  class="w-full max-w-6xl">
               <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full px-3">
                          <div class="block">
                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Customer Type
                              </label>
                              <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="customer_type" value="BUSINESS" checked wire:model="customer_type" wire:click="$set('show', true)">
                                <span class="ml-2">Business</span>
                              </label>
                              <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="customer_type" value="INDIVIDUAL" checked wire:model="customer_type" wire:click="$set('show', false)">
                                <span class="ml-2">Individual</span>
                              </label>
                              @error('customer_type') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                      </div>
                </div>
                <div class="flex flex-wrap md:w-1/2 -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Primary Contact
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4  leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                            name="first_name" type="text" placeholder="FIRST NAME" wire:model="first_name">
                              @error('first_name') <span class="text-red-700">{{ $message }}</span> @enderror
                          </div>
                          <div class="w-full md:w-1/2 my-6">
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4  leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                                id="grid-last-name" name="last_name" type="text" placeholder="LAST NAME" wire:model="last_name">
                                @error('last_name') <span class="text-red-700">{{ $message }}</span> @enderror
                          </div>
                </div>
                @if($show)
                <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Company Name
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="company_name" type="text" placeholder="" wire:model="company_name">
                             @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          
                </div>
                @endif
                <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Email
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="customer_email" type="text" placeholder="" wire:model="customer_email">
                             @error('customer_email') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Phone
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="phone" type="text" placeholder="" wire:model="phone">
                             @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Website
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="website" type="text" placeholder="" wire:model="website">
                             @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                              Branch
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="branch" type="text" placeholder="" wire:model="branch">
                             @error('branch') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <div id='map'></div>
                </div>
                
               
                <x-jet-button wire:click.prevent="store()" class="bg-orange-500 hover:bg-orange-700">
                     Save
                </x-jet-button>

                 

                </div>
</form>
  
