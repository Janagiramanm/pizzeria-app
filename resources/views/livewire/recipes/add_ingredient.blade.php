<h2 class="font-semibold text-xl text-gray-800 leading-tight my-6 ml-10">
            {{ __('Add New Ingredient') }}
</h2>
<br>
<x-jet-secondary-button wire:click="view()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 -my-20">
    Recipes
</x-jet-button>
<form  class="w-full max-w-6xl ml-10 mr-10">


<div class="add-input">
<div class="flex">
     <div wire:ignore class="md:w-1/5 m-2"> 
                  <x-jet-label for="item" value="{{ __('Ingredients') }}" />
                  <select id="item.0" wire:model.defer="item.0"  class="select2 block mt-1 w-4/5 p-2 bg-gray-200" name="item.0">
                        <option value="">Select Item</option>
                        @foreach ($materials as $material)
                              <option value="{{ $material->id }}">
                                    {{ ucfirst($material->name) }} ({{ $material->uom }})
                              </option>
                       @endforeach
                  </select>
                  @error('item.0') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
     </div> 
     <div class="md:w-1/5 m-2"> 
                <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
                <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="quantity.0"
                  name="quantity.0" type="text" placeholder="" wire:model.defer="quantity.0">
                 @error('quantity.0') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
     </div> 
     
        <button class="btn text-green btn-info btn-sm" data-no="{{$i}}" wire:click.prevent="add({{$i}})">Add</button>
    
</div>
</div>

@foreach($inputs as $key => $value)
<div class=" add-input">
    <div class="row">
    <div class="flex">
            <div class="md:w-1/5 m-2"> 
                              <x-jet-label for="item" value="{{ __('Ingredients') }}" />
                              <select id="item.{{ $value }}" wire:model.defer="item.{{$value}}"  class="select2 block mt-1 w-4/5 p-2 bg-gray-200" name="item.{{$value}}">
                                    <option value="">Select Item</option>
                                    @foreach ($materials as $material)
                                          <option value="{{ $material->id }}">
                                                {{ ucfirst($material->name) }} ({{ $material->uom }})
                                          </option>
                                    @endforeach
                              </select>
                              @error('item.{{ $value }}') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
            </div> 
            <div class="md:w-1/5 m-2"> 
                        <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
                        <input class="appearance-none block w-4/5 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4   leading-tight focus:outline-none focus:bg-white" id="quantity.{{ $value }}" 
                              name="quantity.{{$value}}" type="text" placeholder="" wire:model.defer="quantity.{{$value}}">
                        @error('quantity.{{$value}}') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
            </div> 
                
            <button class="btn btn-danger text-red btn-sm" wire:click.prevent="remove({{$key}})">remove</button>
                  
            </div>

        
    </div>
</div>
@endforeach
<div class="md:w-1/5 m-2"> 
      <x-jet-button wire:click.prevent="saveNewIngredient()" class="bg-orange-500 hover:bg-orange-700  mt-4">
            Add Ingredient
      </x-jet-button>   

      <x-jet-button wire:click.prevent="goBack()" class="bg-orange-500 hover:bg-orange-700  mt-4">
            Back
      </x-jet-button>   
      

</div>


</form>
<script>
    $(document).ready(function () {

        $('.select2').select2();
        $('.select2').on('change', function (e) {
            var item = $(this).select2("val");
            var name = $(this).attr('name');
            @this.set(name, item);
        });
     $('#addMoreBtn').click(function(){
          
            setTimeout(() => {
            $('.select2').select2();
            $('.select2').trigger('change');
            $('.select2').on('change', function (e) {
                        var item = $(this).select2("val");
                        var name = $(this).attr('name');
                        @this.set(name, item);
                  });
            }, 300);
      })
     
       
     
    });

</script>
<style>
.select2 select {
  background: transparent;
  width: 250px;
  font-size: 16px;
  border: 1px solid #CCC;
  height: 44px;
}
.select2 {
  /* margin: 50px; */
  width: 220px;
  height: 44px;
  border: 1px solid #111;
  border-radius: 3px;
  overflow: hidden;
  
}
.select2-container .select2-selection--single {
      height: 44px;
}

.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #3e8e41;
}

</style>