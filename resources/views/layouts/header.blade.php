<header class="bg-blue-800 dark:bg-blue-950 text-white p-4 flex">
    <section class="container mx-auto flex flex-row justify-between">
        <!-- Logo -->
        <div class="shrink-0 flex items-center gap-2">
            <a href="{{ route('welcome') }}"
               class="hover:saturate-200 transition-all duration-500 ease-in-out">
                <x-application-logo class="block h-12 w-auto fill-current"/>
            </a>
            <h1 class="text-3xl font-semibold">
                <a href="{{ route('welcome') }}">Workopia</a>
            </h1>
        </div>

        <div class="flex justify-between">
            @auth
                @include('layouts.navigation')
            @else
                @include('layouts.navigation-guest')
            @endauth
        </div>

        <!-- New Job Post -->
        <div class="flex">
            <x-nav-link :href="route('listings.create')" :active="request()->routeIs('listings.create')"
               class="ml-6 px-4 rounded-md py-2
                      text-black bg-yellow-400 shadow shadow-black/70
                      hover:text-yellow-300 hover:bg-yellow-600 hover:shadow-none
                      transition duration-300 h-10">
                <i class="fa fa-edit mr-2"></i> {{ __('Post a Job') }}
            </x-nav-link>
        </div>
    </section>
</header>
