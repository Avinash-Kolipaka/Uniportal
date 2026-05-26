<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-bold text-2xl text-gray-800">Attendees for: {{ $event->title }}</h2>
            <a href="{{ route('proposer.dashboard') }}" class="text-sm text-primary hover:underline">← My Events</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($attendees->count() > 0)
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">#</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Name</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Email</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Expressed Interest</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($attendees as $i => $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-500">{{ $attendees->firstItem() + $i }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->pivot->created_at->format('M d, Y g:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4 border-t border-gray-100">{{ $attendees->links() }}</div>
        @else
            <div class="p-16 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <p class="text-gray-500 text-lg font-medium">No one has expressed interest yet.</p>
            </div>
        @endif
    </div>
</x-app-layout>
