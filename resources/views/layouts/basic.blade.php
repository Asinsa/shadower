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
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1>Shadower - @yield('title')</h1>
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
            <div class="w-full md:w-3/4 lg:w-4/5 p-5 md:px-12 lg:24 h-full overflow-x-scroll antialiased">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>