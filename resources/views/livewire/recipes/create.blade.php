<h2 class="font-semibold text-xl text-gray-800 leading-tight my-6 ml-10">
            {{ __('Add New Recipe') }}
</h2>
<x-jet-secondary-button wire:click="view()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 -my-20 ">
           Recipes
      </x-jet-button>

      <form  class="w-full max-w-6xl ml-10 mr-10">

            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                            <x-jet-label for="ame " value="{{ __('Product Name') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                              name="name" type="text" placeholder="" wire:model="name">
                             @error('name') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 

            </div>
            <div class="add-input">
            <div class="flex">
                 <div class="md:w-1/5 m-2"> 
                              <x-jet-label for="item" value="{{ __('Ingredients') }}" />
                              <select id="item.0" wire:model.defer="item.0"  class="block mt-1 w-4/5 p-2 bg-gray-200" name="item.0">
                                    <option value="">Select City</option>
                                    @foreach ($materials as $material)
                                          <option value="{{ $material->id }}">
                                                {{ ucfirst($material->name) }} ({{ $material->uom }})
                                          </option>
                                   @endforeach
                              </select>
                 </div> 
                 <div class="md:w-1/5 m-2"> 
                            <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
                            <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="quantity.0"
                              name="quantity.0" type="text" placeholder="" wire:model.defer="quantity.0">
                             @error('quantity') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
                 
                    <button class="btn text-green btn-info btn-sm" wire:click.prevent="add({{$i}})">Add</button>
                
            </div>
            </div>
           
            @foreach($inputs as $key => $value)
            <div class=" add-input">
                <div class="row">
                <div class="flex">
                        <div class="md:w-1/5 m-2"> 
                                          <x-jet-label for="item" value="{{ __('Ingredients') }}" />
                                          <select id="item.{{ $value }}" wire:model.defer="item.{{$value}}"  class="block mt-1 w-4/5 p-2 bg-gray-200" name="item.{{$value}}">
                                                <option value="">Select City</option>
                                                @foreach ($materials as $material)
                                                      <option value="{{ $material->id }}">
                                                            {{ ucfirst($material->name) }} ({{ $material->uom }})
                                                      </option>
                                                @endforeach
                                          </select>
                        </div> 
                        <div class="md:w-1/5 m-2"> 
                                    <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
                                    <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="quantity.{{ $value }}" 
                                          name="quantity.{{$value}}" type="text" placeholder="" wire:model.defer="quantity.{{$value}}">
                                    @error('quantity') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                        </div> 
                            
                        <button class="btn btn-danger text-red btn-sm" wire:click.prevent="remove({{$key}})">remove</button>
                              
                        </div>
                    
                </div>
            </div>
            @endforeach
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