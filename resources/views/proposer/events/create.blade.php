<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-bold text-2xl text-gray-800">Create New Event</h2>
            <a href="{{ route('proposer.dashboard') }}" class="text-sm text-primary hover:underline">← My Events</a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('proposer.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('proposer.events._form')

            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('proposer.dashboard') }}" class="py-2.5 px-6 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">Cancel</a>
                <x-primary-button class="py-2.5 px-8">Create Event</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
