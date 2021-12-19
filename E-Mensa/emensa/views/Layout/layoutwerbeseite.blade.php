<!DOCTYPE html>
<html lang="de" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>E-Mensa</title>
    <link rel="stylesheet" href="/CSS/index.css">
</head>
<body>
<nav id="About us">@yield('navbereich')</nav>
<img src="https://www.dhbw-stuttgart.de/fileadmin/_processed_/0/e/csm_1104x387_Mensa_Studierende-essen_ff83a2ee57.jpg"
     class="FrontBild">
<main id="home" class="grid-container">
    @yield('begrüßungstext')
    @yield('gerichtetabelle')
    @yield('EmensaInZahlen')
    @yield('Newsletter')
</main>
<div class="griditem4">
    <h1>Das ist uns wichtig</h1>
    <ul>
        <li>Beste frische Zutaten</li>
        <li>Ausgewogene abwechslungsreiche Gerichte</li>
        <li>Sauberkeit</li>
    </ul>
</div>
<div class="griditem5">
    <a>Wir freuen uns auf ihren Besuch!</a>
    <footer id="Contact">@yield('impressum')</footer>
</div>
</body>
</html>