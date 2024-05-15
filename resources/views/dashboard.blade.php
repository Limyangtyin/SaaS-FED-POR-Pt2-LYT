<x-app-layout>

    <x-slot name="navigation">
    </x-slot>

    <x-slot name="topBanner">
        <section class="bg-blue-900 text-white py-6 text-center">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold">Unlock Your Career Potential</h2>
                <p class="text-lg mt-2">
                    Discover the perfect job opportunity for you.
                </p>
            </div>
        </section>

    </x-slot>

    <div class="py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="pb-6 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
