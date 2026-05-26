<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-bold text-2xl text-gray-800">My Events</h2>
            <a href="{{ route('proposer.events.create') }}" class="inline-flex items-center gap-2 bg-primary text-white font-bold px-5 py-2.5 rounded-lg hover:bg-blue-800 transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Create Event
            </a>
        </div>
    </x-slot>

    @if($events->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Title</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Category</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Date</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Interests</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Status</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($events as $event)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900 max-w-xs truncate">{{ $event->title }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-blue-100 text-primary text-xs font-bold rounded">{{ $event->category->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $event->date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('proposer.events.attendees', $event) }}" class="text-primary font-bold hover:underline">
                                    {{ $event->interestedUsers()->count() }} interested
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                @if($event->is_active)
                                    <span class="px-2 py-1 bg-green-100 text-success text-xs font-bold rounded">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-500 text-xs font-bold rounded">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('proposer.events.edit', $event) }}" class="px-3 py-1 text-xs bg-indigo-100 text-indigo-700 hover:bg-indigo-200 rounded transition font-semibold">Edit</a>
                                    <form action="{{ route('proposer.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this event?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs bg-red-100 text-danger hover:bg-red-200 rounded transition font-semibold">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4 border-t border-gray-100">{{ $events->links() }}</div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-16 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <h3 class="text-lg font-bold text-gray-700 mb-2 font-heading">No Events Yet</h3>
            <p class="text-gray-500 mb-6">You haven't created any events. Start by creating your first one!</p>
            <a href="{{ route('proposer.events.create') }}" class="inline-block bg-primary text-white font-bold px-6 py-3 rounded-lg hover:bg-blue-800 transition shadow-sm">
                Create First Event
            </a>
        </div>
    @endif
</x-app-layout>
