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
    <link rel="stylesheet" href="/CSS/profile.css">
</head>
<body>
<div class="profile">
    <h3>@yield('title')</h3>
    @yield('content')
    <footer>
    </footer>
</div>
</body>
