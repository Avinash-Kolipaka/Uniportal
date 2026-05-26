<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('is_active', true)->with(['category', 'user']);

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('theme')) {
            $query->where('theme', 'like', "%{$request->theme}%");
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->filled('date_from')) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('date', '<=', $request->date_to);
        }

        $events = $query->latest('date')->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('events.index', compact('events', 'categories'));
    }

    public function show(Event $event)
    {
        if (!$event->is_active) {
            abort(404);
        }
        
        $isInterested = false;
        if (auth()->check()) {
            $isInterested = auth()->user()->interestedEvents()->where('event_id', $event->id)->exists();
        }

        return view('events.show', compact('event', 'isInterested'));
    }

    public function toggleInterest(Event $event)
    {
        $user = auth()->user();
        
        if ($user->interestedEvents()->where('event_id', $event->id)->exists()) {
            $user->interestedEvents()->detach($event->id);
            $message = 'Interest removed.';
        } else {
            $user->interestedEvents()->attach($event->id);
            $message = 'Interest expressed successfully.';
        }

        return back()->with('success', $message);
    }
}
