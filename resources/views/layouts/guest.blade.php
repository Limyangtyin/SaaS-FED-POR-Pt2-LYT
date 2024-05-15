<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=atkinson-hyperlegible:400,400i,700,700i" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css'])

</head>
<body class="bg-gray-100 font-sans text-gray-900 antialiased min-h-screen flex flex-col justify-start">

@include('layouts.dev-mode')

@include('layouts.header')

<!-- Nav -->
@if(isset($navigation))
    {{ $navigation }}
@else

@endif

@if (isset($showcase))
    {{ $showcase }}
@endif

@if (isset($topBanner))
    {{ $topBanner }}
@endif

<main class="bg-gray-100 dark:bg-gray-900 grow">
    <div class="mx-auto container mt-6 px-6 py-4 overflow-hidden ">
        {{ $slot }}
    </div>
</main>

@if (isset($bottomBanner))
    {{ $bottomBanner }}
@endif

@include('layouts.footer')

@vite([ 'resources/js/app.js',])

</body>
</html>
