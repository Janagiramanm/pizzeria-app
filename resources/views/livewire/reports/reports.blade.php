

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
                                          <option value="{{ $key }}" >
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
                                <th rowspan="2" class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                    S.No  
                                </th>
                                <th rowspan="2"  class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                    Item 
                                </th>
                                <th colspan="2" class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                   Used
                                  
                                </th>
                                <th colspan="2" class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider"> 
                                   Wastage
                                </th>
                                
                               
                             </tr>
                               <tr>
                                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
                                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Price</th>
                                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Quantity</th>
                                    <th class="px-5 py-3 border-2 border-gray-200 bg-gray-100 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Price</th>
                                </tr>
                            
                                @if(!$result)
                                   <tr><td colspan="6" class="text-center">No Result Found</td></tr>
                                @else

                                     @php $no = 1;
                                     $recipes = [];
                                     $items = [];

                                     @endphp
                        
                                    @foreach($result as $sales)
                                      
                                        @foreach($sales->recipes->recipeIngredients as $ingredients)
                                            @php 
                                                if(isset($sales->quantity)!='' && isset($ingredients->quantity)!=''){
                                                    $recipes[$ingredients->rawMaterial->uom][$ingredients->rawMaterial->name]['used_qty'][]= ( (int) $sales->quantity * (int) $ingredients->quantity ) ;
                                                    $recipes[$ingredients->rawMaterial->uom][$ingredients->rawMaterial->name]['price']= $ingredients->rawMaterial->price;
                                                    $recipes[$ingredients->rawMaterial->uom][$ingredients->rawMaterial->name]['ppl']= $ingredients->rawMaterial->ppl;
                                                }
                                            @endphp 
                                        @endforeach
                                    @endforeach

                                                                    
                                    @if(!empty($recipes))
                                      
                                       @foreach($recipes as $key => $items)
                                                @foreach($items as $item => $value)
                                                @php 
                                                        $used_qty =  array_sum($value['used_qty']);
                                                        $used_price = (int) $value['used_qty'] * (int) $value['price'];
                                                        $waste_qty = '';
                                                        $waste_price = '';
                                                        $ukey =$key;
                                                        $wkey =$key;
                                                        
                                                        if($value['ppl'] > 0){
                                                           $waste_qty = (int) $value['used_qty'] * ( (int) $value['ppl'] / 100);
                                                       
                                                        }
                                                        if($used_qty >= 1000 && $key != 'nos'){
                                                            $used_qty = $used_qty / 1000 ;
                                                            $used_price = $used_qty * (int) $value['price'];
                                                            $waste_qty = $used_qty * ( (int) $value['ppl'] / 100);
                                                            if($key == 'gms'){
                                                                 $ukey = 'Kg';
                                                            }
                                                            if($key == 'ml'){
                                                                $ukey ='Ltr';
                                                            }
                                                        }
                                                        if($waste_qty >= 1 && $key != 'nos'){
                                                            if($key == 'gms'){
                                                                 $wkey = 'Kg';
                                                            }
                                                            if($key == 'ml'){
                                                                $wkey ='Ltr';
                                                            }
                                                        }
                                                        if($key != 'nos'){
                                                                $waste_price = $waste_qty * $value['price'];
                                                        }
                                                        
                                                @endphp
                                                        <tr>
                                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $no++ }}  </td>
                                                            <td class="border px-4 py-2">{{ isset($item) ? $item : '' }}</td>
                                                            <td class="border px-4 py-2">{{ $used_qty."  ". $ukey  }}</td>
                                                            <td class="border px-4 py-2 text-right">{{ number_format((float)$used_price, 2, '.', '') }}</td>
                                                            <td class="border px-4 py-2">{{ $waste_qty ? $waste_qty."  ". $wkey : ''  }}</td>
                                                            <td class="border px-4 py-2 text-right">{{ $waste_price ? number_format((float)$waste_price, 2, '.', '') : '' }}</td>
                                                            
                                                        </tr>
                                                @endforeach
                                        @endforeach
                                    @else
                                          <tr>
                                              <td colspan="4"> No Records Found </td>
                                          </tr>
                                    @endif
                                    
                                @endif
                         </table>
                         {{ $result->links() }}
                    </div>
              
        </div>
      
<style>
      #map{
            height: 600px; 
            width: 100%; 
      }
</style> 




  



