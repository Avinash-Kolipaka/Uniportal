<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function interests()
    {
        $events = auth()->user()->interestedEvents()->with('category')->latest()->paginate(10);
        return view('user.interests', compact('events'));
    }
}
