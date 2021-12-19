<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pizzerialocale') }}</title>

        <!-- Fonts -->
       
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <!-- <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">  -->
        <link href="https://cdn.tailwindcss.com" rel="stylesheet"> 
        
        
        <!-- <link href="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css" rel="stylesheet"> -->
       

        @livewireStyles

        <!-- Scripts -->
         <script src="{{ mix('js/app.js') }}" defer></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        

        <!-- Select2 -->
        <script type="text/javascript" src="https://unpkg.com/moment"></script>
    
    </head>
    <body class="font-sans antialiased">
       
        
        <div class=" grid grid-cols-12 min-h-screen bg-gray-100">
            <div class="col-span-12 row-span-1 bg-gray-100 fixed">  @livewire('navigation-menu') </div>
            <div class="col-span-2 h-screen sticky fixed top-0">
                         
                       <div class="bg-gray-800 shadow-xl h-18 fixed bottom-0  md:relative md:h-screen z-10 w-full">

                                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                                  
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <x-jet-nav-link href="{{ route('dashboard') }}">
                                        {{ __('Pizzerialocale') }}
                                    </x-jet-nav-link>
                                </div>
                                <div class="flex-shrink-0 flex items-center">
                                    <a href="{{ route('dashboard') }}">
                                        <x-jet-application-mark class="block h-9 w-auto" />
                                        
                                    </a>
                                </div>
                                    <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left ">
                                        <li class="my-px">
											<span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase bg-purple-50 w-60 p-3">Masters</span>
										</li>
                                        <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
                                           <li class="mr-3 flex-1">
                                                <x-jet-nav-link href="{{ route('raw-materials') }}" :active="request()->routeIs('roles')">
                                                        <i class="fas fa-user-tag pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Raw Material</span>
                                                </x-jet-nav-link>
                                            </li>
											<li class="mr-3 flex-1">
                                                <x-jet-nav-link href="{{ route('recipes') }}" :active="request()->routeIs('recipes')">
                                                        <i class="fas fa-city pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Recipes</span>
                                                </x-jet-nav-link>
                                            </li>
                                            <li class="mr-3 flex-1">
                                                <x-jet-nav-link href="{{ route('sales') }}" :active="request()->routeIs('sales')">
                                                <i class="fas fa-comment-dollar pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block">Sales</span>
                                                </x-jet-nav-link>
                                            </li>
											
                                        </ul>
                                        <li class="my-px">
											<span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase bg-purple-50 w-60 p-3">Reports</span>
										</li>
                                       
                                    </ul>
                                </div>
                        </div>
            </div> 
            <div class="col-span-10 ">  
                @if (isset($header))
                    <header class="bg-white shadow mt-0 w-full">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                <main class="">
                    {{ $slot }}
                </main>
            </div>
          
        @stack('modals')
        @stack('styles')
        @stack('scripts')
        @stack('js');
        @livewireScripts
       
       
    </body>
</html>
