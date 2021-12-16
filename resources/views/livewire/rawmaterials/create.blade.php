<h2 class="font-semibold text-xl text-gray-800 leading-tight my-6 ml-10">
            {{ __('Add New') }}
</h2>
<x-jet-secondary-button wire:click="view()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 -my-20 ">
           Raw Materials
      </x-jet-button>

      <form  class="w-full max-w-6xl ml-10 mr-10">

            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="ame " value="{{ __('Item Name') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="name" type="text" placeholder="" wire:model="name">
                             @error('name') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 

            </div>
            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                              <x-jet-label for="uom" value="{{ __('UOM') }}" />
                              <select id="uom" wire:model="uom"  class="block mt-1 w-4/5 p-2 bg-gray-200" name="uom">
                                    <option value="">Select UOM</option>
                                    <option value="gms">Gms</option>
                                    <option value="ml">ML</option>
                                    <option value="nos">Nos</option>
                              </select>
                              @error('uom') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror 
                 </div> 
            </div>
            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="quantity" type="text" placeholder="" wire:model="quantity">
                             @error('quantity') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
            </div>

            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="ppl" value="{{ __('PPL ( % )') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="ppl" type="text" placeholder="" wire:model="ppl">
                             @error('ppl') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
            </div>
            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="ppl" value="{{ __('Price') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="price" type="text" placeholder="" wire:model="price">
                             @error('price') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
            </div>
           
            @if($createMode)
                  <x-jet-button wire:click.prevent="store()" class="bg-orange-500 hover:bg-orange-700  mt-4">
                        Save
                  </x-jet-button>
            @elseif($updateMode)
                      <x-jet-button wire:click.prevent="update()" class="bg-orange-500 hover:bg-orange-700  mt-4">
                            Update
                      </x-jet-button>
            @endif

</form>