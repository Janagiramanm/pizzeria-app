<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet"> 
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />
        
        <div class=" grid grid-cols-12 min-h-screen bg-gray-100">
            <div class="col-span-12 row-span-1 bg-gray-100 fixed">  @livewire('navigation-menu') </div>
            <div class="col-span-2 h-screen sticky top-0">
                
                        <div class="bg-gray-800 shadow-xl h-16 fixed bottom-0 mt-14 md:relative md:h-screen z-10 w-full">

                                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                                    <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
                                        <li class="mr-3 flex-1">
                                            <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                                 <i class="fas fa-tachometer-alt pr-0 md:pr-3"></i></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Dashboard</span>
                                            </x-jet-nav-link>
                                          
                                        </li>
                                        <li class="mr-3 flex-1">
                                            <x-jet-nav-link href="{{ route('tasks.index') }}" :active="request()->routeIs('tasks.index')">
                                                 <i class="fas fa-tachometer-alt pr-0 md:pr-3"></i></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Tasks</span>
                                            </x-jet-nav-link>
                                           
                                        </li>
                                        <li class="mr-3 flex-1">
                                            <a href="{{ route('tasks.index') }}" :active="request()->routeIs('tasks.index')" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">
                                            <i class="fas fa-user-astronaut pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Roles</span>
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </div>
                        </div>
            </div>
            <div class="col-span-10 ">  
                @if (isset($header))
                    <header class="bg-white shadow mt-20 w-full fixed">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                <main class="mt-28">
                    {{ $slot }}
                </main>
        </div>
    

           
          
        @stack('modals')

        @livewireScripts
    </body>
</html>
