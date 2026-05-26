<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-bold text-2xl text-gray-800">My Interests</h2>
    </x-slot>

    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition flex flex-col group">
                    @if($event->banner_image)
                        <img src="{{ Storage::url($event->banner_image) }}" alt="Banner" class="w-full h-44 object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-44 bg-gradient-to-r from-blue-100 to-indigo-100 flex items-center justify-center">
                            <span class="text-primary font-heading font-bold text-lg">{{ $event->category->name }}</span>
                        </div>
                    @endif
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <span class="bg-blue-100 text-primary text-xs font-bold px-2 py-1 rounded uppercase">{{ $event->category->name }}</span>
                            <span class="text-xs text-gray-500">{{ $event->date->format('M d, Y') }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1 font-heading">{{ $event->title }}</h3>
                        <p class="text-xs text-gray-500 mb-3 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            {{ $event->location }}
                        </p>
                        <div class="mt-auto flex gap-2">
                            <a href="{{ route('events.show', $event) }}" class="flex-1 text-center text-sm font-semibold bg-gray-50 border border-gray-200 text-primary py-2 rounded hover:bg-primary hover:text-white transition">View</a>
                            <form action="{{ route('events.interest', $event) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-2 text-sm bg-red-50 border border-red-200 text-danger rounded hover:bg-danger hover:text-white transition font-semibold" title="Remove Interest">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $events->links() }}</div>
    @else
        <div class="bg-white p-16 rounded-xl shadow-sm border border-gray-100 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            <h3 class="text-lg font-bold text-gray-700 mb-2 font-heading">No Saved Interests</h3>
            <p class="text-gray-500 mb-6">Browse events and click "Express Interest" to save them here.</p>
            <a href="{{ route('events.index') }}" class="inline-block bg-primary text-white font-bold px-6 py-3 rounded-lg hover:bg-blue-800 transition shadow-sm">Browse Events</a>
        </div>
    @endif
</x-app-layout>
