<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'UniPortal') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-background">
        <div class="min-h-screen flex items-stretch">
            <!-- Left branding panel -->
            <div class="hidden lg:flex lg:w-1/2 bg-primary flex-col items-center justify-center p-12 text-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full"><path fill="#FFFFFF" d="M40.5,-65.2C52.3,-58.4,61.2,-46.2,67.3,-32.7C73.4,-19.2,76.7,-4.5,74.2,9.4C71.7,23.2,63.4,36.3,53.1,47.3C42.9,58.3,30.6,67.3,16.9,70.7C3.1,74.1,-11.9,72,-25.4,66.5C-38.9,61.1,-50.9,52.4,-60.1,41.2C-69.3,30,-75.6,16.4,-75.8,2.6C-76,-11.1,-70,-25,-62,-38.2C-54,-51.3,-44,-63.7,-32.2,-70.5C-20.4,-77.3,-6.8,-78.5,5.6,-85.7C18.1,-92.9,28.7,-72,40.5,-65.2Z" transform="translate(100 100)" /></svg>
                </div>
                <div class="relative z-10 text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
                        <svg class="w-12 h-12 text-accent" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    </div>
                    <h1 class="font-heading text-4xl font-extrabold mb-3">UniPortal</h1>
                    <p class="text-blue-100 text-lg mb-8">Your university event management platform</p>
                    <div class="space-y-3 text-left">
                        <div class="flex items-center gap-3 bg-white bg-opacity-10 rounded-lg p-3">
                            <svg class="w-5 h-5 text-accent shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-sm text-blue-100">Discover events across all categories</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white bg-opacity-10 rounded-lg p-3">
                            <svg class="w-5 h-5 text-accent shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-sm text-blue-100">Proposers can create & manage events</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white bg-opacity-10 rounded-lg p-3">
                            <svg class="w-5 h-5 text-accent shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-sm text-blue-100">Admin-validated, secure platform</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right form panel -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-6 py-12 sm:px-12">
                <div class="w-full max-w-md">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-8 group lg:hidden">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        </div>
                        <span class="font-heading font-extrabold text-xl text-primary">UniPortal</span>
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
