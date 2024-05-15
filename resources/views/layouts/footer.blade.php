<footer class="w-full bg-gray-800 text-gray-500 p-8">
    <div class="container mx-auto my-6 bg-blue-800 text-white rounded p-4 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Looking to hire?</h2>
            <p class="text-gray-200 text-lg mt-2">
                Post your job listing now and find the perfect candidate.
            </p>
        </div>
        <a href="post-job.html"
           class="ml-6 px-4 rounded-md py-2
                  text-black bg-yellow-400 shadow shadow-md shadow-black/70
                  hover:text-yellow-300 hover:bg-yellow-600 hover:shadow-none
                  transition duration-300 h-10">
            <i class="fa fa-edit"></i> Post a Job
        </a>
    </div>

    <div class="container p-4 mx-auto flex flex-col xl:flex-row items-start xl:items-center
                justify-start xl:justify-between text-sm gap-2 sm:gap-0.5">
        <section class="flex flex-row gap-2 items-center h-8 md:h-12">
            <x-application-logo class='w-8 md:w-12 text-white'/>
            <h5 class="text-md">Workopia</h5>
        </section>

        <section id="copyright">
            <p>
                &copy; Copyright 2024, All rights reserved YOUR NAME, Traversy Media &amp; Adrian Gould
            </p>
        </section>

        <section id="footerNav" class="flex flex-col sm:flex-row gap-1 -ml-1">
            <x-nav-link :href="route('welcome')"
                        class="border-none text-gray-500 hover:text-gray-300 -my-1">
                {{ __('Welcome') }}
            </x-nav-link>
            <x-nav-link :href="route('welcome')"
                        class="border-none text-gray-500 hover:text-gray-300 -my-1">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('welcome')"
                        class="border-none text-gray-500 hover:text-gray-300 -my-1">
                {{ __('Contact Us') }}
            </x-nav-link>
            <x-nav-link :href="route('welcome')"
                        class="border-none text-gray-500 hover:text-gray-300 -my-1">
                {{ __('About') }}
            </x-nav-link>
            <x-nav-link :href="route('welcome')"
                        class="border-none text-gray-500 hover:text-gray-300 -my-1">
                {{ __('Pricing') }}
            </x-nav-link>
        </section>
    </div>
</footer>


@include('layouts.dev-mode')
