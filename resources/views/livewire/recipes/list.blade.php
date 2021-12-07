
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipes') }}
        </h2>
  
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        @if($updateMode)
            @include('livewire.recipes.update')
        @elseif($createMode)
            @include('livewire.recipes.create')
        @elseif($editIngredientMode)
            @include('livewire.recipes.update_ingredient')
        @elseif($addnewIngredients)
            @include('livewire.recipes.add_ingredient')
        @else
            <table class="table-fixed w-full">
                          
                            <x-jet-secondary-button wire:click="create()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 my-6">
                                        Add New 
                            </x-jet-button>
                    
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 w-20">No.</th>
                                    <th class="px-4 py-2">Recipe Name</th>
                                    <th class="px-4 py-2">Ingredients</th>                                   
                                    <th class="px-4 py-2">Quantity</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>   
                            </thead>
                            <tbody>
                            @php $no = 1; @endphp
                                @foreach($recipes as $recipe)
                                    <tr class="">
                                        <td class="border px-4 py-2">{{ $no++ }}</td>
                                        <td class="border px-4 py-2" colspan="3">{{ ucfirst($recipe->product_name) }}</td>
                                        <td class="border px-4 py-2">
                                        <x-jet-button wire:click="edit( {{ $recipe->id}})" class="bg-orange-500 hover:bg-orange-700 m-1 w-20">
                                            View 
                                        </x-jet-button>
                                        <!-- <x-jet-danger-button wire:click="confirmItemDeletion( {{ $recipe->id}})" wire:loading.attr="disabled" class="m-1 w-20">
                                           Delete
                                        </x-jet-danger-button> -->
                                        </td>
                                    </tr>
                                    <!-- @foreach($recipe->recipeIngredients as $ingredients)
                                    <tr>
                                        <td class="border px-4 py-2"></td>
                                        <td class="border px-4 py-2"></td>
                                        <td class="border px-4 py-2">{{ $ingredients->rawMaterial->name }}</td>
                                        <td class="border px-4 py-2">{{ $ingredients->quantity }}</td>
                                        <td class="border px-4 py-2">
                                        </td>
                                    </tr>
                                    @endforeach -->
                                @endforeach
                            </tbody>
            </table>
            @endif


            

</div>
</div>
</div>
