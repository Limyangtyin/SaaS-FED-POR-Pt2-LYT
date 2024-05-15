@if (Route::has('login'))
    <nav class="space-x-4 flex justify-between">
        <a href="{{ route('login') }}"
           class="rounded-md px-3 py-2 text-white
                  ring-1 ring-transparent transition hover:text-white/70
                  focus:outline-none focus-visible:ring-[#FF2D20]
                  dark:text-white dark:hover:text-white/80
                  dark:focus-visible:ring-white
                  duration-200">
            <i class="fa fa-door-open mr-2 text-md group-hover:text-blue-400 duration-150"></i>
            {{ __('Log in') }}
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}"
               class="rounded-md px-3 py-2 text-white
                      ring-1 ring-transparent transition hover:text-white/70
                      focus:outline-none focus-visible:ring-[#FF2D20]
                      dark:text-white dark:hover:text-white/80
                      dark:focus-visible:ring-white
                      duration-200">
                <i class="fa fa-file-signature mr-2 text-md group-hover:text-blue-400 duration-150"></i>
                {{ __('Register') }}
            </a>
        @endif
    </nav>
@endif
