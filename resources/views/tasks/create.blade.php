<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
    <x-jet-validation-errors class="mb-4" />

     <div class="w-3/6 m-auto">
     <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <x-jet-input id="description" type="text" name="description" class="mt-1 block w-full disabled:opacity-50" wire:model.defer="state.description" autocomplete="description" />
                
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </form>
     </div>
      
    </div>
    </div>
    </div>

</x-app-layout>