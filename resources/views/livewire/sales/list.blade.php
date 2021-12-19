
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales') }}
        </h2>
  
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        @if($updateMode)
            @include('livewire.sales.update')
        @elseif($createMode)
            @include('livewire.sales.create')
        @else
            <table class="table-fixed w-full">
                          
                            <x-jet-secondary-button wire:click="create()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 my-6">
                                        Add New Sales
                            </x-jet-button>

                            <div class="md:w-1/2 m-2"> 
                                    <select id="month"  wire:model="searchTerm"   class="block mt-1 w-4/5 p-2 bg-gray-200" name="item.0">
                                            <option value="">Select Month</option>
                                            @foreach ($months as $key => $month)
                                                <option value="{{ $key }}">
                                                        {{ ucfirst($month) }}  
                                                </option>
                                        @endforeach
                                    </select>
                            </div>
                    
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 w-20">No.</th>
                                    <th class="px-4 py-2 w-20">Month</th>
                                    <th class="px-4 py-2">Recipe Name</th>
                                    <th class="px-4 py-2">Quantity</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>   
                            </thead>
                            <tbody>
                            @php $no = 1;
                           
                            @endphp
                                @foreach($sales as $sale)
                                    <tr class="">
                                        <td class="border px-4 py-2">{{ $no++ }}</td>
                                        <td class="border px-4 py-2" >{{ $this->months[$sale->month] }}</td>
                                        <td class="border px-4 py-2" >{{ $sale->recipes->product_name }}</td>
                                        <td class="border px-4 py-2" >{{ $sale->quantity}}</td>
                                       
                                        <td class="border px-4 py-2">
                                        <x-jet-button wire:click="edit({{$sale->id}})" class="bg-orange-500 hover:bg-orange-700 m-1 w-20">
                                            Edit 
                                        </x-jet-button>
                                        
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
            </table>
            @endif


            

</div>
</div>
</div>
