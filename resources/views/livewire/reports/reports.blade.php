

     <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
  
</x-slot>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
<div class="flex">
        <div   class="w-full mt-2 mr-1 ml-1 "> 
        
               
                    <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                    <x-jet-label for="user_id" value="{{ __('Month') }}" />
                                    <select id="month" wire:model.defer="month"   class="block mt-1 w-4/5 p-2  bg-gray-200" name="month">
                                    <option value="">Select Month</option>
                                    @foreach ($months as $key => $month)
                                          <option value="{{ $key }}">
                                                {{ ucfirst($month) }}  
                                          </option>
                                   @endforeach
                                   </select>
                                   @error('month') <span class="font-mono text-xs text-red-700">{{ $message }}</span> @enderror
                            </div>
                          
                            <div class="w-1/5">
                                 <x-jet-button  class="bg-orange-500 hover:bg-orange-700  mt-4" wire:click="generateWorkReport()" >
                                        Generate
                                 </x-jet-button>

                                 <x-jet-button  class="bg-orange-500 hover:bg-orange-700  mt-4" wire:click="backToReports()">
                                        Reset
                                 </x-jet-button> 
                            </div>
                            
                    </div>
                    <div wire:loading class="flex ml-24 justify-center items-center">
                       <div class="flex justify-center items-center">
                        <div
                            class="
                            animate-spin
                            rounded-full
                            h-20
                            w-20
                            border-t-2 border-b-2 border-purple-500
                            "
                        ></div>
                        </div>  
                    </div>
                                    
                  
                    <div wire:loading.remove>
                         <table class="min-w-full leading-normal">
                             <tr>
                                <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                    S.No  
                                </th>
                                <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                    Item 
                                </th>
                                <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                   Used
                                </th>
                                <th  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                UOM</th>
                              
                               
                             </tr>
                                @if(!$result)
                                   <tr><td colspan="6" class="text-center">No Result Found</td></tr>
                                @else

                                     @php $no = 1;
                                     $items = [];
                                     @endphp
                        
                                    @foreach($result as $sales)
                                      @php 
                                      echo '<pre>';
                                                     print_r($sales);
                                        @endphp
                                        @foreach($sales->recipes->recipeIngredients as $ingredients)
                                            @php 
                                                
                                                    // print_r($ingredients);
                                                 $items[$ingredients->rawMaterial->name][]= (int) $sales->quantity * (int) $ingredients->quantity;
                                            @endphp 
                                        @endforeach
                                    @endforeach
                                    
                                    @if(!empty($items))
                                        @foreach($items as $item => $value)
                                        @php 
                                                $quantity = array_sum($items[$item]);
                                        @endphp
                                                <tr>
                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $no++ }}  </td>
                                                    <td class="border px-4 py-2">{{ isset($item) ? $item : '' }}</td>
                                                    <td class="border px-4 py-2">{{ $quantity }}</td>
                                                    <td class="border px-4 py-2">{{ isset($ingredients->rawMaterial->uom) ? $ingredients->rawMaterial->uom : '' }}</td>
                                                    
                                                </tr>
                                        @endforeach
                                    @else
                                          <tr>
                                              <td colspan="4"> No Records Found </td>
                                          </tr>
                                    @endif
                                    
                                @endif
                         </table>
                    </div>
                    
               
                
               
           
                  
         
        </div>
      
<style>
      #map{
            height: 600px; 
            width: 100%; 
      }
</style> 




  



