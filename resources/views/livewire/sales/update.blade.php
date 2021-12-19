<h2 class="font-semibold text-xl text-gray-800 leading-tight my-6 ml-10">
            {{ __('Add New Sale') }}
</h2>
<x-jet-secondary-button wire:click="view()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 -my-20 ">
           Sales
      </x-jet-button>

      <form  class="w-full max-w-6xl ml-10 mr-10">
      
            <div class="flex">
                 <div class="md:w-1/5 m-2"> 
                              <x-jet-label for="month" value="{{ __('Month') }}" />
                              <select id="month" wire:model.defer="month"  class="block mt-1 w-4/5 p-2 bg-gray-200" name="item.0">
                                    <option value="">Select Month</option>
                                    @foreach ($months as $key => $month)
                                          <option value="{{ $key }}">
                                                {{ ucfirst($month) }}  
                                          </option>
                                   @endforeach
                              </select>
                              @error('month') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                 </div> 
            </div> 
            <div class="flex">
                 <div class="md:w-1/2 m-2"> 
                              <x-jet-label for="item" value="{{ __('Recipe') }}" />
                              <select id="item" wire:model.defer="item"  class="block mt-1 w-4/5 p-2 bg-gray-200" name="item">
                                    <option value="">Select Recipe</option>
                                    @foreach ($recipes as $recipe)
                                          <option value="{{ $recipe->id }}">
                                                {{ ucfirst($recipe->product_name) }}  
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
            
            <x-jet-button wire:click.prevent="update()" class="bg-orange-500 hover:bg-orange-700  mt-4">
                  Update
            </x-jet-button>
            <x-jet-danger-button wire:click="confirmItemDeletion( {{ $sales_id}})" wire:loading.attr="disabled" class="m-1 w-20">
                  Delete
            </x-jet-danger-button>

            <x-jet-confirmation-modal wire:model="confirmingItemDeletion">
                    <x-slot name="title">
                        {{ __('Delete Item') }}
                    </x-slot>
            
                    <x-slot name="content">
                        {{ __('Are you sure you want to delete Item? ') }}
                    </x-slot>
            
                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$set('confirmingItemDeletion', false)" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>
            
                        <x-jet-danger-button class="ml-2" wire:click="deleteSale({{ $confirmingItemDeletion }})" wire:loading.attr="disabled">
                            {{ __('Delete') }}
                        </x-jet-danger-button>
                    </x-slot>
            </x-jet-confirmation-modal>
</form>
