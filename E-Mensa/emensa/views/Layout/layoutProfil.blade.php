<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>@yield('bartitle')</title>
</head>
<body>
<div class="container">
    <header>
        <h3>@yield('title')</h3>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
    </footer>
</div>
</body>
