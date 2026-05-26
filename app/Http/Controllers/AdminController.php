<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'pending_users' => User::where('status', 'pending')->count(),
            'total_events' => Event::count(),
            'active_events' => Event::where('is_active', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $request->validate(['status' => 'required|in:approved,rejected']);
        $user->update(['status' => $request->status]);

        return back()->with('success', "User status updated to {$request->status}.");
    }

    public function events()
    {
        $events = Event::with(['user', 'category'])->paginate(10);
        return view('admin.events', compact('events'));
    }

    public function toggleEventStatus(Event $event)
    {
        $event->update(['is_active' => !$event->is_active]);
        return back()->with('success', 'Event status toggled successfully.');
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event deleted successfully.');
    }
}
