<x-app-layout>
    <div class="py-12">
        <!-- Hero Section -->
        <div class="bg-primary text-white rounded-2xl p-10 md:p-16 shadow-xl mb-12 text-center md:text-left flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2">
                <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-4 leading-tight">
                    Discover & Create <span class="text-accent">Amazing Campus Events</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 mb-8 font-sans">
                    UniPortal is your one-stop platform for all university events. Connect, collaborate, and discover what's happening around you.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ route('events.index') }}" class="px-8 py-3 bg-accent text-white font-bold rounded-lg hover:bg-yellow-500 transition shadow-lg text-center">
                        Browse Events
                    </a>
                    @guest
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-primary font-bold rounded-lg hover:bg-gray-100 transition shadow-lg text-center">
                        Get Started
                    </a>
                    @endguest
                </div>
            </div>
            <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
                <!-- Decorative Graphic -->
                <div class="relative w-64 h-64 md:w-80 md:h-80 bg-white bg-opacity-10 rounded-full flex items-center justify-center">
                    <div class="absolute inset-4 bg-white bg-opacity-20 rounded-full animate-pulse"></div>
                    <svg class="w-32 h-32 text-accent relative z-10" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Featured Events -->
        <h2 class="text-3xl font-heading font-bold text-gray-800 mb-8">Featured Events</h2>
        @if($featuredEvents->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredEvents as $event)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition flex flex-col">
                        @if($event->banner_image)
                            <img src="{{ Storage::url($event->banner_image) }}" alt="Banner" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center">
                                <span class="text-primary font-heading font-bold text-xl">{{ $event->category->name }}</span>
                            </div>
                        @endif
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-blue-100 text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                    {{ $event->category->name }}
                                </span>
                                <span class="text-sm text-gray-500 font-medium">
                                    {{ $event->date->format('M d, Y') }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 font-heading">{{ $event->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 flex-grow line-clamp-3">{{ $event->description }}</p>
                            <a href="{{ route('events.show', $event) }}" class="mt-auto block text-center w-full bg-gray-50 text-primary border border-gray-200 font-semibold py-2 rounded-lg hover:bg-primary hover:text-white transition">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                <p class="text-gray-500 text-lg">No events are currently happening. Check back later!</p>
            </div>
        @endif
    </div>
</x-app-layout>
