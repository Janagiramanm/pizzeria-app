<h2 class="font-semibold text-xl text-gray-800 leading-tight my-6 ml-10">
            {{ __('Update Recipe') }}
</h2>
<br>
<x-jet-secondary-button wire:click="view()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 -my-20">
    Recipes
</x-jet-button>
<form  class="w-full max-w-6xl ml-10 mr-10">

<div class="flex">
     <div class="md:w-1/2 m-2"> 
                <x-jet-label for="name " value="{{ __('Product Name') }}" />
                <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="grid-first-name" 
                  name="name" type="text" placeholder="" wire:model="name">
                 @error('name') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
     </div> 

</div>
<div class="w-1/2">
<div>
   <b>Ingredients Details</b>   <span class="float-right cursor-pointer" wire:click="addNewIngredients({{ $this->recipe_id }})"><i class="fa fa-plus" aria-hidden="true"></i> Add New Ingredient</span>
</div>
</div>
<table class="table-fixed">
        <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Ingredients</th>                                   
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Action</th>
                    
                </tr> 
                @foreach($inputs as $key => $value)
                    <tr>
                    <td>{{ $value->rawMaterial->name }} </td>
                    <td>{{ $value->quantity}}</td>
                    <td>
                        <i class="fas fa-edit " wire:click="editIngredient({{ $value->id }})"></i>
                        <i class="fas fa-trash-alt" wire:click="confirmItemDeletion({{ $value->id }})"></i>
                    </td>
                    </tr> 
                @endforeach
        </thead>
</table>

<x-jet-button wire:click.prevent="update()" class="bg-orange-500 hover:bg-orange-700  mt-4">
                Update
</x-jet-button>
<x-jet-danger-button wire:click="confirmingRecipeDeletion({{ $this->recipe_id }})" wire:loading.attr="disabled" class="m-1 w-20">
                                           Delete
</x-jet-danger-button>

</div>


         

</form>
<x-jet-confirmation-modal wire:model="confirmingRecipeDeletion">
                    <x-slot name="title">
                        {{ __('Delete Item') }}
                    </x-slot>
            
                    <x-slot name="content">
                        {{ __('Are you sure you want to delete Recipe? ') }}
                    </x-slot>
            
                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$set('confirmingItemDeletion', false)" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-secondary-button>
            
                        <x-jet-danger-button class="ml-2" wire:click="deleteRecipe({{ $confirmingRecipeDeletion }})" wire:loading.attr="disabled">
                            {{ __('Delete') }}
                        </x-jet-danger-button>
                    </x-slot>
</x-jet-confirmation-modal>

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
            
                        <x-jet-danger-button class="ml-2" wire:click="deleteIngredient({{ $confirmingItemDeletion }})" wire:loading.attr="disabled">
                            {{ __('Delete') }}
                        </x-jet-danger-button>
                    </x-slot>
</x-jet-confirmation-modal>