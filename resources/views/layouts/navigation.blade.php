<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700 mb-1">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-12">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current  text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-x-8 -my-px ml-10 flex debug-borde">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('Settings') }}
                    </x-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" class="p-0 ">
                        @csrf
                        <x-nav-link :href="route('logout')" class="h-full" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
