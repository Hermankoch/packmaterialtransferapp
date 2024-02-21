<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta content="Barney Koch" name="author" />

    <title>Pack Material Transfer</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ vite_asset('resources/sass/app.scss') }}">
    <script type="module" src="{{ vite_asset('resources/js/app.js') }}"></script>
</head>
<body class="bg-body-secondary">
@yield('content')
@yield('scripts')
</body>
</html>
