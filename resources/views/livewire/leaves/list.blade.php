<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaves') }}
        </h2>
  
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
       
            <table class="table-fixed w-full">
                          
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 w-20">No.</th>
                                    <th class="px-4 py-2">User Name</th>
                                    <th class="px-4 py-2">From Date</th>
                                    <th class="px-4 py-2">To Date</th>
                                    <th class="px-4 py-2">Reason</th>
                                    <th class="px-4 py-2">Available CL</th>
                                    <th class="px-4 py-2">Available ML</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>   
                            </thead>
                            <tbody>
                            @php $no = 1; @endphp
                                @foreach($leaves as $leave)
                                <tr>
                                    <td class="border px-4 py-2">{{ $no++ }}</td>
                                   
                                    <td class="border px-4 py-2">{{ $leave->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $leave->from_date }}</td>
                                    <td class="border px-4 py-2">{{ $leave->to_date }}</td>
                                    <td class="border px-4 py-2">{{ $leave->reason }}</td>
                                    <td class="border px-4 py-2">{{ $leave->leave->available_cl }}</td>
                                    <td class="border px-4 py-2">{{ $leave->leave->available_ml }}</td>
                                    <td class="border px-4 py-2">{{ $leave->status }}</td>
                                    <td class="border px-4 py-2">
                                        <x-jet-button wire:click="edit( {{ $leave->id}})" class="bg-orange-500 hover:bg-orange-700 m-1 w-25">
                                            Approve
                                        </x-jet-button>
                                        <x-jet-button wire:click="edit( {{ $leave->id}})" class="bg-red-500 hover:bg-red-700 m-1 w-25">
                                            Cancel
                                        </x-jet-button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
            </table>
        

</div>
</div>
</div>
