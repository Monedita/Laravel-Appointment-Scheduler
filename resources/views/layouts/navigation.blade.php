<nav x-data="{ open: false }" class="bg-indigo-800 text-white border-b-1 border-gray-600 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('aboutus') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:ml-10 flex">
                    <x-nav-link :href="route('aboutus')" :active="request()->routeIs('aboutus')">
                        {{ __('About Us') }}
                    </x-nav-link>
                </div>
                <div class="space-x-8 sm:-my-px sm:ml-10 flex">
                    <x-nav-link :href="route('appointment')" :active="request()->routeIs('appointment')">
                        {{ __('Appointment') }}
                    </x-nav-link>
                </div>
                @auth
                @if (Auth::user()->admin)
                <div class="space-x-8 sm:-my-px sm:ml-10 flex">
                    <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                        {{ __('Admin') }}
                    </x-nav-link>
                </div>
                @endif
                @endauth
            </div>

            <!-- Session Links -->
            <div class="flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @auth
                        <button class="flex items-center text-sm font-medium text-gray-200 hover:text-white hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        @endauth
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                
                @guest
                <a href="{{ route('login') }}" class="text-sm text-gray-200 underline">Log in</a>
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-200 underline">Register</a>
                @endguest
            </div>
        </div>
    </div>
</nav>
