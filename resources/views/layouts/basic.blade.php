<!DOCTYPE html>

<head>
    <title>Shadower - @yield('title')</title>
</head>

<body>
    <h1>Shadower - @yield('title')</h1>

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
    
    <div>
        @yield('content')
    </div>

 </html>