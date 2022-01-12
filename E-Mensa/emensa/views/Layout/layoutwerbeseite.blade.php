<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<!DOCTYPE html>
<html lang="de" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>E-Mensa</title>
    <link rel="stylesheet" href="/CSS/index.css">
</head>
<body class="grid-container">
<header>
    <nav id="About us">@yield('navbereich')</nav>
</header>

<main id="home" class="main">
    <img src="https://www.dhbw-stuttgart.de/fileadmin/_processed_/0/e/csm_1104x387_Mensa_Studierende-essen_ff83a2ee57.jpg" class="FrontBild">
    @yield('begrüßungstext')
    @yield('gerichtetabelle')
    @yield('hervorgehobeneGerichte')
    @yield('EmensaInZahlen')
    @yield('Newsletter')
    <div class="ListImportant">
        <h1>Das ist uns wichtig</h1>
        <ul>
            <li>Beste frische Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>
</main>

<div class="footer">
    <a>Wir freuen uns auf ihren Besuch!</a>
    <footer id="Contact">@yield('impressum')</footer>
</div>
</body>
</html>