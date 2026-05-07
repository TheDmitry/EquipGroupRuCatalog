<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Каталог товаров</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container">
                <a class="navbar-brand" href="{{ route('catalog.index') }}">Каталог товаров</a>
            </div>
        </nav>
    </header>

    <div class="container">
        @yield('content')
    </div>

</body>

</html>