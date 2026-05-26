<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-bold text-2xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Users</p>
                <p class="text-3xl font-heading font-bold text-gray-900">{{ $stats['total_users'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-yellow-100 p-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-yellow-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Pending Approvals</p>
                <p class="text-3xl font-heading font-bold text-gray-900">{{ $stats['pending_users'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Events</p>
                <p class="text-3xl font-heading font-bold text-gray-900">{{ $stats['total_events'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-green-100 p-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-7 h-7 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Active Events</p>
                <p class="text-3xl font-heading font-bold text-gray-900">{{ $stats['active_events'] }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('admin.users') }}" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-primary transition group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-50 group-hover:bg-primary flex items-center justify-center transition">
                    <svg class="w-6 h-6 text-primary group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-heading font-bold text-gray-900 group-hover:text-primary transition">Manage Users</h3>
                    <p class="text-sm text-gray-500">Approve or reject user registrations</p>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.events') }}" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-primary transition group">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-indigo-50 group-hover:bg-primary flex items-center justify-center transition">
                    <svg class="w-6 h-6 text-indigo-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <div>
                    <h3 class="font-heading font-bold text-gray-900 group-hover:text-primary transition">Manage Events</h3>
                    <p class="text-sm text-gray-500">Toggle event status or remove events</p>
                </div>
            </div>
        </a>
    </div>
</x-app-layout>
