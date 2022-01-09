<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>@yield('bartitle')</title>
    <link rel="stylesheet" href="/CSS/bewertung.css">
</head>
<body>
<header>
    <h3>@yield('title')</h3>
</header>
<main>
    <div>
        @yield('Bild')
        @yield('form')
    </div>
</main>
</body>

