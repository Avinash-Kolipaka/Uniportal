<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-heading font-bold text-2xl text-gray-800">Manage Users</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-primary hover:underline">← Dashboard</a>
        </div>
    </x-slot>

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.users') }}" class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 flex flex-wrap gap-4 items-end">
        <div>
            <x-input-label for="role" value="Role" />
            <select id="role" name="role" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                <option value="">All Roles</option>
                <option value="proposer" {{ request('role') == 'proposer' ? 'selected' : '' }}>Proposer</option>
                <option value="end_user" {{ request('role') == 'end_user' ? 'selected' : '' }}>End-User</option>
            </select>
        </div>
        <div>
            <x-input-label for="status" value="Status" />
            <select id="status" name="status" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <x-primary-button type="submit">Filter</x-primary-button>
        <a href="{{ route('admin.users') }}" class="py-2 px-4 bg-gray-200 text-gray-700 rounded-md text-sm hover:bg-gray-300 transition">Clear</a>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Name</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Email</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Unique ID</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Role</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Status</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-gray-600 font-mono text-xs">{{ $user->unique_id }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs font-bold uppercase
                                {{ $user->role === 'proposer' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ str_replace('_', ' ', $user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->status === 'pending')
                                <span class="px-2 py-1 rounded text-xs font-bold bg-yellow-100 text-yellow-700">Pending</span>
                            @elseif($user->status === 'approved')
                                <span class="px-2 py-1 rounded text-xs font-bold bg-green-100 text-green-700">Approved</span>
                            @else
                                <span class="px-2 py-1 rounded text-xs font-bold bg-red-100 text-red-700">Rejected</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($user->role !== 'admin')
                                <div class="flex items-center gap-2">
                                    @if($user->status !== 'approved')
                                        <form action="{{ route('admin.users.status', $user) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="px-3 py-1 text-xs bg-success text-white rounded hover:bg-green-600 transition font-semibold">Approve</button>
                                        </form>
                                    @endif
                                    @if($user->status !== 'rejected')
                                        <form action="{{ route('admin.users.status', $user) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="px-3 py-1 text-xs bg-danger text-white rounded hover:bg-red-600 transition font-semibold">Reject</button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <span class="text-xs text-gray-400 italic">Admin</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-10 text-center text-gray-500">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-gray-100">{{ $users->links() }}</div>
    </div>
</x-app-layout>
