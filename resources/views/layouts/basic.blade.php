<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shadower - @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire -->
    @livewireStyles
</head>

<body class="font-sans antialiased">

    @livewireScripts

    @include('layouts.navigation')
    <div class="dark:bg-black">
        <div class="main-scrolly-section">
            <div class="p-4 mx-auto max-w-7xl">

                <!-- Page Heading -->
                <header class="header-section">
                    <div class="header-text">
                        <h1>@yield('title')</h1>
                    </div>
                </header>

                <!-- Errors -->
                @if ($errors->any())
                    <div>
                        Errors:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><b>{{ $error }}</b></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Page Content -->
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>

</html>