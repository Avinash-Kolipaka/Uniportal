<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProposerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $featuredEvents = \App\Models\Event::where('is_active', true)->latest()->take(3)->get();
    return view('welcome', compact('featuredEvents'));
})->name('home');

// Public Event Routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Authenticated Routes
Route::middleware(['auth', 'approved'])->group(function () {
    
    // Express Interest
    Route::post('/events/{event}/interest', [EventController::class, 'toggleInterest'])->name('events.interest');
    
    // End User Routes
    Route::get('/my-interests', [UserController::class, 'interests'])->name('user.interests');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::patch('/users/{user}/status', [AdminController::class, 'updateUserStatus'])->name('users.status');
        Route::get('/events', [AdminController::class, 'events'])->name('events');
        Route::patch('/events/{event}/toggle', [AdminController::class, 'toggleEventStatus'])->name('events.toggle');
        Route::delete('/events/{event}', [AdminController::class, 'deleteEvent'])->name('events.destroy');
    });

    // Proposer Routes
    Route::middleware(['proposer'])->prefix('proposer')->name('proposer.')->group(function () {
        Route::get('/events', [ProposerController::class, 'dashboard'])->name('dashboard');
        Route::get('/events/create', [ProposerController::class, 'createEvent'])->name('events.create');
        Route::post('/events', [ProposerController::class, 'storeEvent'])->name('events.store');
        Route::get('/events/{event}/edit', [ProposerController::class, 'editEvent'])->name('events.edit');
        Route::put('/events/{event}', [ProposerController::class, 'updateEvent'])->name('events.update');
        Route::delete('/events/{event}', [ProposerController::class, 'deleteEvent'])->name('events.destroy');
        Route::get('/events/{event}/attendees', [ProposerController::class, 'attendees'])->name('events.attendees');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirect generic dashboard route based on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') return redirect()->route('admin.users');
    if ($user->role === 'proposer') return redirect()->route('proposer.dashboard');
    return redirect()->route('events.index');
})->middleware(['auth', 'approved'])->name('dashboard');

require __DIR__.'/auth.php';
