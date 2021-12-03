<?php
include 'MenuFunction.php';
include 'MenufunctionDB.php';

session_start();
$mypage = 'index.php';
if (!isset($_SESSION['refresher'])) {
    $_SESSION['refresher'] = 0;
} else {
    $_SESSION['refresher']++;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../emensa/public/index.css">
</head>

<body>
<nav id="About us">
<!-- Navigationsbar -->
<ul class="navbar">
    <li><img src="https://logosmarken.com/wp-content/uploads/2020/11/Red-Bull-Logo.png" class="logo"></li>
    <li><a class="active" href="#home">Home</a></li>
    <li><a href="#News">Nachrichten</a></li>
    <li><a href="#meals">Speisen</a></li>
    <li><a href="#numbers">Zahlen</a></li>
    <li><a href="#Contact">Kontakt</a></li>
    <li><a href="#About us">Wichtig für uns</a></li>
</ul>
</nav>

<!-- Front Bild -->
<img src="https://www.dhbw-stuttgart.de/fileadmin/_processed_/0/e/csm_1104x387_Mensa_Studierende-essen_ff83a2ee57.jpg"
     class="FrontBild">

<main id="home" class="grid-container">
    <!-- Text -->
    <div id="News" class="griditem griditem1">
        <h1>Bald gibt es Essen auch online ;)</h1>
        Mensen verpflegen – häufig in Verbindung mit Cafeterien – in erster Linie die Studenten und die Mitarbeiter
        von Hochschulen mit warmem Mittagessen, zum Teil auch Abendessen.
        Hochschulmensen gehören mit je bis zu 12.000 ausgegebenen Essen am Tag zu den größten Einrichtungen der
        Gemeinschaftsverpflegung.[1]
        In einigen Ländern werden Mensen von staatlicher Seite subventioniert, um die Teilnahme am Hochschulstudium
        finanziell zu fördern.
        Gegen einen Zuschlag als Subventionsausgleich stehen fast alle Mensen auch Gästen offen, die von außerhalb
        der Hochschule kommen.
        In Deutschland werden die meisten Mensen von den öffentlich-rechtlichen Studentenwerken betrieben, bei denen
        die soziale Unterstützung der Studenten gebündelt ist.
        Es gibt 58 selbständige Studentenwerke, die rund 700 gastronomische Einrichtungen betreiben; entsprechend
        unterschiedlich sind diese.
        [2] In Österreich werden die meisten Mensen von einer nationalen Betriebsgesellschaft unterhalten.
        In vielen anderen Ländern werden die Mensen von den Hochschulen selbst oder von gewinnorientierten Caterern
        betrieben.
    </div>
    <!-- Tabelle -->
    <div id="meals" class="griditem griditem2">
        <h1>Köstlichkeiten, die Sie erwarten</h1>
        <table>
            <thead>
            <tr>
                <th></th>
                <th> Preis intern</th>
                <th> Preis extern</th>
                <th> Allergene</th>
            </tr>
            </thead>
            <tbody>
            <?php menu(); ?>
            </tbody>
        </table>
        <?php
        allergenList();
        ?>
    </div>
    <!-- E-Mensa in zahlen -->
    <div class="griditem griditem3 grid-container-2">
        <h1 id="numbers" class="griditem2-1"> E-Mensa in Zahlen</h1>
        <div class="griditem-2 griditem2-2">
            <?php echo $_SESSION['refresher']; ?> Besuche
        </div>
        <div class="griditem-2 griditem2-3"><a class="br">
                <?php
                if (isset($count))
                    echo $count;
                else {
                    $count2 = file_get_contents('erfolgreicheAnmeldungen.txt');
                    echo $count2;
                }
                ?> Anmeldungen zum </a> Newsletter
        </div>
        <div class="griditem-2 griditem2-4"> <?php getRows(); ?> Speisen</div>
    </div>
    <!-- Eingabefeld -->
    <div class="uberschrift"></div>
    <form class="griditem griditem4 grid-container-3" method="post" action="checkFormular.php">
        <h1 class="griditem3-1"> Interesse geweckt? Wir informieren Sie!</h1>
        <div class="griditem-3 griditem3-2">
            <a class="br">Ihr Name:</a>
            <input type="text" name="text" <?php echo 'placeholder="' . htmlspecialchars('Vorname') . '"'; ?>>
        </div>

        <div class="griditem-3 griditem3-3">
            <a class="br">Ihre E-Mail:</a>
            <input type="text" name="email" <?php echo 'placeholder="' . htmlspecialchars('Max@Musterman.gmx.de') . '"'; ?>>
        </div>
        <div class="griditem-3 griditem3-4">
            <a class="br">Newsletter bitte in:</a>
            <select name="language">
                <option <?php echo 'value="' . htmlspecialchars('deutsch') . '"'; ?>>Deutsch</option>
                <option <?php echo 'value="' . htmlspecialchars('englisch') . '"'; ?>>Englisch</option>
                <option <?php echo 'value="' . htmlspecialchars('niederländisch') . '"'; ?>>Niederländisch</option>
                <option <?php echo 'value="' . htmlspecialchars('Spanisch') . '"'; ?>>Spanisch</option>
            </select>
        </div>

        <div class="griditem-3 griditem3-5">
            <p class="error"><?php if (isset($benutzername_error)) {
                    echo $benutzername_error;
                } ?></p>
            <p class="error"><?php if (isset($email_error)) {
                    echo $email_error;
                } ?></p>
            <input type="checkbox" name="checkbox">
            Den Datenschutzbestimmungen Stimme ich zu

            <input type="submit" name="submit" <?php echo 'value="' . htmlspecialchars('Zum Newsletter anmelden') . '"'; ?> class="br post">
            <p class="error"><?php if (isset($checkbox_error)) {
                    echo $checkbox_error;
                } ?></p>
            <p><?php if (isset($noerror)) {
                    echo $noerror;
                } ?></p>
        </div>
    </form>
    <!-- Liste -->
    <div class="griditem4">
        <h1>Das ist uns wichtig</h1>
        <ul>
            <li>Beste frische Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>
    <!-- Impressum -->
    <div class="griditem5">
        <a>Wir freuen uns auf ihren Besuch!</a>
        <footer id="Contact">
            <ol class="Impressum">
                <li><a>(c) E-Mensa GmbH &nbsp&nbsp|&nbsp&nbsp</a></li>
                <li><a>Name &nbsp&nbsp|&nbsp&nbsp</a></li>
                <li><a href=index.php> Impressum &nbsp&nbsp|&nbsp&nbsp</a></li>
                <li><a href="wunschgericht.php"> Wunschgericht </a></li>
            </ol>
        </footer>
    </div>
</main>

</body>
