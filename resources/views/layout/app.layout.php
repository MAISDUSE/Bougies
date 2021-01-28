<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Document</title>

    @yield('head')

</head>
<body>
    <header>
        <h1>Header</h1>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>

    </footer>

    @yield('scripts')
</body>
</html>
