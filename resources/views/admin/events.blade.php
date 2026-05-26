<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-bold text-2xl text-gray-800">Manage Events</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-primary hover:underline">← Dashboard</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Title</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Proposer</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Category</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Date</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Status</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($events as $event)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900 max-w-xs truncate">{{ $event->title }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $event->user->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-blue-100 text-primary text-xs font-bold rounded">{{ $event->category->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $event->date->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            @if($event->is_active)
                                <span class="px-2 py-1 bg-green-100 text-success text-xs font-bold rounded">Active</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-danger text-xs font-bold rounded">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <form action="{{ route('admin.events.toggle', $event) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="px-3 py-1 text-xs {{ $event->is_active ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} rounded transition font-semibold">
                                        {{ $event->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this event?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-xs bg-red-100 text-danger hover:bg-red-200 rounded transition font-semibold">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-10 text-center text-gray-500">No events found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-gray-100">{{ $events->links() }}</div>
    </div>
</x-app-layout>
