<x-guest-layout>
    <div class="mb-8">
        <h2 class="font-heading text-3xl font-bold text-gray-900">Create account</h2>
        <p class="text-gray-500 mt-1">Join UniPortal — pending admin approval</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Unique ID -->
        <div>
            <x-input-label for="unique_id" :value="__('Unique ID Number')" />
            <x-text-input id="unique_id" class="block mt-1 w-full" type="text" name="unique_id" :value="old('unique_id')" required placeholder="e.g. STU-2024-001" />
            <p class="mt-1 text-xs text-gray-400">Your university-issued ID number</p>
            <x-input-error :messages="$errors->get('unique_id')" class="mt-2" />
        </div>

        <!-- Role -->
        <div>
            <x-input-label for="role" :value="__('I am a...')" />
            <select id="role" name="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="end_user" {{ old('role') == 'end_user' ? 'selected' : '' }}>End-User (Browse events)</option>
                <option value="proposer" {{ old('role') == 'proposer' ? 'selected' : '' }}>Proposer (Create events)</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-700 mb-4">
                <strong>Note:</strong> Your account will be reviewed by an admin before you can log in.
            </div>
            <x-primary-button class="w-full justify-center py-3 text-base">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">Sign in</a>
        </p>
    </form>
</x-guest-layout>
