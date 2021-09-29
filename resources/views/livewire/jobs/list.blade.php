<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jobs') }}
        </h2>
  
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        @if($updateMode)
            @include('livewire.jobs.create')
        @elseif($createMode)
            @include('livewire.jobs.create')
        @else
            <table class="table-fixed w-full">
                          
                            <x-jet-secondary-button wire:click="create()" class=" float-right bg-orange-500 hover:bg-gray-300 hover:text-white-100 px-4 py-2 my-6">
                                        Add New Job
                            </x-jet-button>
                    
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 w-20">No.</th>
                                    <th class="px-4 py-2">Customer Type</th>
                                    <th class="px-4 py-2">Customer Name</th>
                                    <th class="px-4 py-2">Task</th>
                                    <th class="px-4 py-2">Employees</th>
                                    <th class="px-4 py-2">Date</th>                                   
                                    <th class="px-4 py-2">Action</th>
                                </tr>   
                            </thead>
                            <tbody>
                            @php $no = 1; @endphp
                                @foreach($jobs as $job)
                                <tr>
                                    <td class="border px-4 py-2">{{ $no++ }}</td>
                                    <td class="border px-4 py-2">{{ $job->customer->customer_type }}</td>
                                    <td class="border px-4 py-2">{{ $job->customer->company_name }}</td>
                                    <td class="border px-4 py-2">{{ $job->task->name }}</td>
                                    <td class="border px-4 py-2">
                                           @foreach ($job->employees as $employee) 
                                                {{ $employee->user->name }} 
                                                <br>
                                           @endforeach

                                    </td>
                                    <td class="border px-4 py-2">{{ $job->date }}</td>
                                    <td class="border px-4 py-2">
                                    <x-jet-button wire:click="edit( {{ $job->id}})" class="bg-orange-500 hover:bg-orange-700 m-1 w-20">
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
