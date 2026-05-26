<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposerController extends Controller
{
    public function dashboard()
    {
        $events = auth()->user()->events()->latest()->paginate(10);
        return view('proposer.dashboard', compact('events'));
    }

    public function createEvent()
    {
        $categories = Category::all();
        return view('proposer.events.create', compact('categories'));
    }

    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'theme' => 'nullable|string|max:255',
            'max_attendees' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('banners', 'public');
            $validated['banner_image'] = $path;
        }

        $validated['is_active'] = true;
        auth()->user()->events()->create($validated);

        return redirect()->route('proposer.dashboard')->with('success', 'Event created successfully.');
    }

    public function editEvent(Event $event)
    {
        if ($event->user_id !== auth()->id()) abort(403);
        $categories = Category::all();
        return view('proposer.events.edit', compact('event', 'categories'));
    }

    public function updateEvent(Request $request, Event $event)
    {
        if ($event->user_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'theme' => 'nullable|string|max:255',
            'max_attendees' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('banner_image')) {
            if ($event->banner_image) {
                Storage::disk('public')->delete($event->banner_image);
            }
            $path = $request->file('banner_image')->store('banners', 'public');
            $validated['banner_image'] = $path;
        }

        $event->update($validated);

        return redirect()->route('proposer.dashboard')->with('success', 'Event updated successfully.');
    }

    public function deleteEvent(Event $event)
    {
        if ($event->user_id !== auth()->id()) abort(403);
        
        if ($event->banner_image) {
            Storage::disk('public')->delete($event->banner_image);
        }
        $event->delete();
        
        return back()->with('success', 'Event deleted successfully.');
    }

    public function attendees(Event $event)
    {
        if ($event->user_id !== auth()->id()) abort(403);
        $attendees = $event->interestedUsers()->paginate(20);
        return view('proposer.events.attendees', compact('event', 'attendees'));
    }
}
