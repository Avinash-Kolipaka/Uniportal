@php
// Shared event form partial
@endphp

<div class="space-y-6">
    <!-- Title -->
    <div>
        <x-input-label for="title" value="Event Title *" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $event->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <!-- Description -->
    <div>
        <x-input-label for="description" value="Description *" />
        <textarea id="description" name="description" rows="5"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            required>{{ old('description', $event->description ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <!-- Date & Time -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-input-label for="date" value="Event Date *" />
            <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date', isset($event) ? $event->date->format('Y-m-d') : '')" required />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="time" value="Event Time *" />
            <x-text-input id="time" name="time" type="time" class="mt-1 block w-full" :value="old('time', $event->time ?? '')" required />
            <x-input-error :messages="$errors->get('time')" class="mt-2" />
        </div>
    </div>

    <!-- Location -->
    <div>
        <x-input-label for="location" value="Location *" />
        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $event->location ?? '')" required />
        <x-input-error :messages="$errors->get('location')" class="mt-2" />
    </div>

    <!-- Category & Theme -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-input-label for="category_id" value="Category *" />
            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Select a category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $event->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="theme" value="Theme (optional)" />
            <x-text-input id="theme" name="theme" type="text" class="mt-1 block w-full" :value="old('theme', $event->theme ?? '')" />
            <x-input-error :messages="$errors->get('theme')" class="mt-2" />
        </div>
    </div>

    <!-- Max Attendees -->
    <div>
        <x-input-label for="max_attendees" value="Max Attendees (optional)" />
        <x-text-input id="max_attendees" name="max_attendees" type="number" min="1" class="mt-1 block w-full" :value="old('max_attendees', $event->max_attendees ?? '')" />
        <x-input-error :messages="$errors->get('max_attendees')" class="mt-2" />
    </div>

    <!-- Banner Image -->
    <div>
        <x-input-label for="banner_image" value="Banner Image (optional, max 2MB: jpg/png/webp)" />
        @if(isset($event) && $event->banner_image)
            <div class="mt-2 mb-3">
                <img src="{{ Storage::url($event->banner_image) }}" alt="Current banner" class="h-32 w-auto rounded-lg shadow border">
                <p class="text-xs text-gray-500 mt-1">Current banner. Upload new to replace.</p>
            </div>
        @endif
        <input id="banner_image" name="banner_image" type="file" accept="image/jpeg,image/png,image/webp"
            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100" />
        <x-input-error :messages="$errors->get('banner_image')" class="mt-2" />
    </div>
</div>
