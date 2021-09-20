<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks List') }}
        </h2>
  
    </x-slot>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif

           
            <table class="table-fixed w-full">
                 <x-jet-nav-link class="my-4 justify-center float-right rounded-md  px-4 py-2 bg-blue-800 text-white  hover:bg-blue-600" href="{{ route('tasks.create') }}" :active="request()->routeIs('tasks.create')">
                                                    {{ __('Add New Task') }}
                </x-jet-nav-link>
           
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                    @foreach($tasks as $task)
                    <tr>
                        <td class="border px-4 py-2">{{ $no++ }}</td>
                        <td class="border px-4 py-2">{{ $task->name }}</td>
                        <td class="border px-4 py-2">{{ $task->description}}</td>
                        <td class="border px-4 py-2">
                                <!-- <button wire:click="edit({{$task->id}})" class="btn btn-sm btn-outline-danger py-0">Edit</button> | 
                                <button wire:click="destroy({{$task->id}})" class="btn btn-sm btn-outline-danger py-0">Delete</button> -->
                         <button type="button" class="float-right bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" wire:click="destroy({{$task->id}})" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Delete</button>
                         <button type="button" class="float-right bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-5" wire:click="edit({{$task->id}})" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                       <div class="modal-body">
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                            <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


    </div>
</div>

</x-app-layout>


