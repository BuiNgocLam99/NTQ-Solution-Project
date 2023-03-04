<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <title>@yield('title')</title>

    @include('layouts.styles')

    @stack('styles')
</head>
<body>
    
    @yield('content')

    @include('layouts.scripts')

    @stack('scripts')
</body>
</html>