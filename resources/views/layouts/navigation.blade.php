<nav x-data="{ open: false }" class="text-white p-0 m-0">
    <!-- Primary Navigation Menu -->
    {{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
    <div class="flex h-10 justify-between">
        <div class="flex">
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center ">
                <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="group">
                    {{ __('Dashboard') }}
                </x-nav-link>

                <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="group">
                    {{ __('Listings') }}
                </x-nav-link>
                <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="group">
                    {{ __('Pricing') }}
                </x-nav-link>

                <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="group">
                    {{ __('Users') }}
                </x-nav-link>
                <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="group">
                    {{ __('About') }}
                </x-nav-link>
                <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="group">
                    {{ __('Contact Us') }}
                </x-nav-link>
            </div>
        </div>


        <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent rounded-md
                                   text-sm leading-4
                                   text-gray-500 dark:text-gray-600
                                   hover:text-gray-600 dark:hover:text-gray-400
                                   bg-gray-100 dark:bg-gray-900
                                   hover:bg-gray-200 dark:hover:bg-gray-800
                                   focus:outline-none
                                   transition ease-in-out duration-300 group">
                        <i class="fa fa-user mr-2 text-md group-hover:text-blue-400 duration-200"></i>
                        <span>{{ Auth::user()->name }}</span>
                        <span class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')" class="group">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication (Logout) -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                         class="group">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        <!-- Hamburger -->
        <div class="ml-4 -me-2 flex items-center sm:hidden">
            <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md
                               text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400
                               hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100
                               dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400
                               transition duration-300 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    {{--    </div>--}}

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden w-full">
        <div class="group pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')"
                                   class="focus:border-yellow-500">
                <i class="fa fa-computer mr-2 text-lg group-hover:text-yellow-400"></i>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')"
                                   class="focus:border-yellow-500">
                <i class="fa fa-list mr-2 text-lg group-hover:text-yellow-400"></i>
                {{ __('Listings') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('/')">
                <i class="fa fa-tag mr-2 text-lg group-hover:text-yellow-400"></i>
                {{ __('Pricing') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')"
                                   class="focus:border-yellow-500">
                <i class="fa fa-users mr-2 text-lg group-hover:text-yellow-400"></i>
                {{ __('Users') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                <i class="fa fa-qrcode mr-2 text-lg group-hover:text-yellow-400"></i>
                {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                <i class="fa fa-address-card mr-2 text-lg group-hover:text-yellow-400"></i>
                {{ __('Contact Us') }}
            </x-responsive-nav-link>

        </div>

        <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')"
                               class="bg-yellow-500 focus:border-yellow-500 rounded-md
                                      my-1">
            <i class="fa fa-edit mr-2"></i> {{ __('Post a Job') }}
        </x-responsive-nav-link>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600 bg-indigo-100 mt-3">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-indigo-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 border-t border-blue-900">
                <x-responsive-nav-link :href="route('profile.edit')" class="focus:border-yellow-500">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           class="focus:border-yellow-500"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
