<h2 class="font-semibold text-xl text-gray-800 leading-tight my-6 ml-10">
            {{ __('Update Ingredient') }}
</h2>
<br>
<x-jet-secondary-button wire:click="view()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 -my-20">
    Recipes
</x-jet-button>
<div class="row">
        <div class="flex">
                        <div class="md:w-1/5 m-2"> 
                                          <x-jet-label for="item" value="{{ __('Ingredients') }}" />
                                          <select id="item" wire:model.defer="item"  class="block mt-1 w-4/5 p-2 bg-gray-200" name="item">
                                                <option value="">Select Item</option>
                                                @foreach ($materials as $material)
                                                      <option value="{{ $material->id }}" >
                                                            {{ ucfirst($material->name) }} ({{ $material->uom }})
                                                      </option>
                                                @endforeach
                                          </select>
                                          @error('item') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                        </div> 
                        <div class="md:w-1/5 m-2"> 
                                    <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
                                    <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="quantity" 
                                          name="quantity" type="text" placeholder="" wire:model.defer="quantity">
                                    @error('quantity') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                        </div> 
                    
        </div>
        <div class="md:w-1/5 m-2"> 
            <x-jet-button wire:click.prevent="updateIngredient()" class="bg-orange-500 hover:bg-orange-700  mt-4">
                  Update Ingredient
            </x-jet-button>   
        </div>
</div>