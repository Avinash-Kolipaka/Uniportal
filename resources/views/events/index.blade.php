<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Browse Events') }}
        </h2>
    </x-slot>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="w-full lg:w-1/4">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-6">
                <h3 class="font-heading font-bold text-lg mb-4">Filters</h3>
                <form action="{{ route('events.index') }}" method="GET">
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="keyword" value="Search" />
                            <x-text-input id="keyword" name="keyword" type="text" class="mt-1 block w-full text-sm" value="{{ request('keyword') }}" placeholder="Title or Description..." />
                        </div>
                        <div>
                            <x-input-label for="category" value="Category" />
                            <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="theme" value="Theme" />
                            <x-text-input id="theme" name="theme" type="text" class="mt-1 block w-full text-sm" value="{{ request('theme') }}" />
                        </div>
                        <div>
                            <x-input-label for="location" value="Location" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full text-sm" value="{{ request('location') }}" />
                        </div>
                        <div>
                            <x-input-label for="date_from" value="Date From" />
                            <x-text-input id="date_from" name="date_from" type="date" class="mt-1 block w-full text-sm" value="{{ request('date_from') }}" />
                        </div>
                        <div>
                            <x-input-label for="date_to" value="Date To" />
                            <x-text-input id="date_to" name="date_to" type="date" class="mt-1 block w-full text-sm" value="{{ request('date_to') }}" />
                        </div>
                    </div>
                    <div class="mt-6 flex gap-2">
                        <x-primary-button class="w-full justify-center">Apply</x-primary-button>
                        <a href="{{ route('events.index') }}" class="w-full text-center py-2 bg-gray-200 text-gray-800 rounded-md text-xs font-semibold uppercase tracking-widest hover:bg-gray-300 transition">Clear</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Event Grid -->
        <div class="w-full lg:w-3/4">
            @if($events->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($events as $event)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition flex flex-col group relative">
                            @if($event->banner_image)
                                <img src="{{ Storage::url($event->banner_image) }}" alt="Banner" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-48 bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center group-hover:scale-105 transition duration-500">
                                    <span class="text-primary font-heading font-bold text-xl">{{ $event->category->name }}</span>
                                </div>
                            @endif
                            <div class="p-5 flex flex-col flex-grow relative bg-white z-10">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="bg-blue-100 text-primary text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">
                                        {{ $event->category->name }}
                                    </span>
                                    <span class="text-xs text-gray-500 font-medium flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $event->date->format('M d') }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1 font-heading">{{ $event->title }}</h3>
                                <p class="text-gray-500 text-xs mb-3 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $event->location }}
                                </p>
                                <p class="text-gray-600 text-sm mb-4 flex-grow line-clamp-2">{{ $event->description }}</p>
                                <a href="{{ route('events.show', $event) }}" class="mt-auto block text-center w-full bg-gray-50 text-primary border border-gray-200 font-semibold py-2 rounded text-sm hover:bg-primary hover:text-white transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $events->links() }}
                </div>
            @else
                <div class="bg-white p-10 rounded-xl shadow-sm text-center border border-gray-100">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <h3 class="text-lg font-bold text-gray-700 mb-1">No events found</h3>
                    <p class="text-gray-500">Try adjusting your filters or search terms.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
