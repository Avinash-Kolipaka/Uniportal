<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Event Details') }}
            </h2>
            <a href="{{ route('events.index') }}" class="text-sm font-medium text-primary hover:underline flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Events
            </a>
        </div>
    </x-slot>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Banner Image -->
        @if($event->banner_image)
            <img src="{{ Storage::url($event->banner_image) }}" alt="Banner" class="w-full h-64 md:h-96 object-cover">
        @else
            <div class="w-full h-64 md:h-96 bg-gradient-to-r from-blue-600 to-indigo-800 flex items-center justify-center">
                <span class="text-white font-heading font-extrabold text-4xl opacity-80">{{ $event->title }}</span>
            </div>
        @endif

        <div class="p-6 md:p-10">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Main Content -->
                <div class="md:w-2/3">
                    <div class="mb-4">
                        <span class="bg-blue-100 text-primary text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mr-2">
                            {{ $event->category->name }}
                        </span>
                        @if($event->theme)
                            <span class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                {{ $event->theme }}
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 mb-6">{{ $event->title }}</h1>
                    
                    <div class="prose max-w-none text-gray-700 leading-relaxed mb-8 whitespace-pre-wrap">{{ $event->description }}</div>

                    <div class="border-t border-gray-100 pt-6">
                        <h3 class="font-heading font-bold text-lg mb-2">Organizer</h3>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold">
                                {{ substr($event->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $event->user->name }}</p>
                                <p class="text-xs text-gray-500">Proposer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="md:w-1/3">
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                        <h3 class="font-heading font-bold text-lg mb-4 border-b border-gray-200 pb-2">Event Info</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-accent mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Date</p>
                                    <p class="text-sm text-gray-600">{{ $event->date->format('l, F j, Y') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-accent mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Time</p>
                                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-accent mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Location</p>
                                    <p class="text-sm text-gray-600">{{ $event->location }}</p>
                                </div>
                            </div>

                            @if($event->max_attendees)
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-accent mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Capacity</p>
                                    <p class="text-sm text-gray-600">Max {{ $event->max_attendees }} attendees</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            @auth
                                <form action="{{ route('events.interest', $event) }}" method="POST">
                                    @csrf
                                    @if($isInterested)
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-white text-danger border-2 border-danger font-bold py-3 px-4 rounded-lg hover:bg-red-50 transition shadow-sm">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                            Remove Interest
                                        </button>
                                    @else
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-800 transition shadow-md">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                            Express Interest
                                        </button>
                                    @endif
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="w-full block text-center bg-gray-800 text-white font-bold py-3 px-4 rounded-lg hover:bg-gray-700 transition shadow-md">
                                    Login to Express Interest
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
