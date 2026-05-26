<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center shadow-sm group-hover:bg-blue-800 transition">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        </div>
                        <span class="font-heading font-extrabold text-xl text-primary tracking-tight">UniPortal</span>
                    </a>
                </div>

                <!-- Navigation Links (desktop) -->
                <div class="hidden sm:flex sm:ms-8 sm:items-center sm:gap-1">
                    <a href="{{ route('events.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('events.*') ? 'bg-blue-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">
                        Browse Events
                    </a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.users') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users') ? 'bg-blue-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">Users</a>
                            <a href="{{ route('admin.events') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.events') ? 'bg-blue-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">Events</a>
                        @elseif(auth()->user()->role === 'proposer')
                            <a href="{{ route('proposer.dashboard') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('proposer.*') ? 'bg-blue-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">My Events</a>
                        @else
                            <a href="{{ route('user.interests') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('user.interests') ? 'bg-blue-50 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition">My Interests</a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right side: Auth buttons or user dropdown -->
            <div class="hidden sm:flex sm:items-center sm:gap-3">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 border border-gray-200 text-sm leading-4 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition">
                                <div class="w-7 h-7 bg-primary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="hidden lg:block">{{ Auth::user()->name }}</div>
                                <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-500">Signed in as</p>
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                                <span class="text-xs px-2 py-0.5 rounded bg-blue-100 text-primary font-bold capitalize">{{ str_replace('_', ' ', Auth::user()->role) }}</span>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-primary hover:underline transition">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-bold bg-primary text-white rounded-lg hover:bg-blue-800 transition shadow-sm">Register</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">Browse Events</x-responsive-nav-link>
            @auth
                @if(auth()->user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">Manage Users</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.events')" :active="request()->routeIs('admin.events')">Manage Events</x-responsive-nav-link>
                @elseif(auth()->user()->role === 'proposer')
                    <x-responsive-nav-link :href="route('proposer.dashboard')" :active="request()->routeIs('proposer.*')">My Events</x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('user.interests')" :active="request()->routeIs('user.interests')">My Interests</x-responsive-nav-link>
                @endif
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-3 border-t border-gray-200 px-4 flex gap-3">
            <a href="{{ route('login') }}" class="flex-1 text-center py-2 text-sm font-semibold text-primary border border-primary rounded-lg">Login</a>
            <a href="{{ route('register') }}" class="flex-1 text-center py-2 text-sm font-bold bg-primary text-white rounded-lg">Register</a>
        </div>
        @endauth
    </div>
</nav>
