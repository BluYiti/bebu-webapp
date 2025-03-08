<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=annie-use-your-telescope:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background-image: url('{{ asset('assests/images/nami_full_bg.jpg') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                height: 100vh;
                margin: 0;
            }
        
            @media (max-width: 640px) {
                body {
                    background-image: url('{{ asset('assests/images/nami_mobile_bg.jpg') }}');
                }
            }
        
            h1{
                font-family: 'Annie Use Your Telescope', cursive;
            }
        </style>
        
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:flex-row">
            <!-- Left Column (Form) -->
            <div class="flex-1 flex flex-col md:justify-center items-center px-6 py-4">
                <h1 class="text-white text-center text-4xl sm:text-5xl md:text-7xl mb-6 md:mb-20">Happy 2nd Anniversary Bebu ko!</h1>
                <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-yellow-800 shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
            
            <!-- Right Column (Optional, can be empty or have content) -->
            <div class="flex-1 hidden sm:block">
                <!-- Optional content for larger screens -->
            </div>
        </div>
    </body>
</html>
