<?php
$TabellenInhalt =
    [
        1 => ['1 1)', '10 min', '10 min', 'keine', 'Tabelle angelegt', 'keine', 'keine'],
        2 => ['1 2)', '10 min', '5 min', 'der Frontcontroller ist mir direkt aufgefallen', 'direkt zu beginn im Frontcontroller', 'Keine', 'keine'],
        3 => ['1 3)', '30 min', '1 Tag', 'mussten zuerst die Anmeldemaske hinzufügen', 'siehe 1 4)', 'keine Anmeldemaske gehabt', 'keine'],
        4 => ['1 4)', '3 Stunden', '1 Tag', 'Wir haben zusätzlich eine Registrierenmaske hinzugefügt um es sinvoller zu gestalten', 'neuen Controller angelegt für das Anmelden/Registrieren, Model für die Anmelde/Registrierung und Validation hinzugefügt', 'keine', 'Vorlesung/Internet'],
        5 => ['1 5)', '10 min', '10 min', 'keine', 'Transaktion begonnen und mit prepared Statements den Befehl UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1 WHERE email = (?) ausgeführt', 'keine', 'Vorlesung/Internet'],
        6 => ['1 6)', '10 min', '10 min', 'keine', 'Transaktion und mit prepared Statements den Befehl UPDATE benutzer SET letzteanmeldung bzw letzterfehler = NOW() WHERE email = (?) ausgeführt', 'keine', 'Internet um den Befehl NOW() zu finden'],
        7 => ['1 7)', '10 min', '5 minuten', 'ging schnell', 'in der Index.blade mit einer Session geprüft ob man angemeldet ist, wenn ja dann wird der benutzer angezeigt', 'keine', 'Vorlesung'],
        8 => ['1 8)', '1 stunde', '45 min', 'ging schneller weil ich wenig coden musste', 'Neuen Controller angelegt und eine neue Blade /profile wo man die Daten des Benutzers sehen kann', 'keine', 'Keine'],
        9 => ['1 9)', '5 min', '5 min', 'keine', 'in den SQL-Anweisungen der Anmeldungen die Funktionen mysqli_begin_transaction und mysqli_commit() verwendet', 'Keine', 'Keine'],
        10 => ['1 10)', '10 min', '10 min', 'keine', 'eine funtion in den Anmeldecontroller fürs abmelden mit dem pfad/abmeldung konfiguriert ', 'keine', 'keine'],
        11 => ['1 11)', '2 stunden', '1 Tag', 'habe zusätzlich noch die Funktion eingebaut um ein Konto zu entsperren', 'Neuen Controller implementiert, wo das konto entsperrt werden kann mit Wiederherstellungscode', 'Speichern in der Datenbank', 'keine'],
        12 => ['1 13)', '5 min', '5 min', 'keine', 'password_hash() und password_verify() verwendet', 'keine', 'internet'],
        13 => ['2 1)', '5 min', '5 min', 'keine', 'Tabelle eingerichtet', 'keine', 'keine'],
        14 => ['2 2)', '1 stunde', 'paar tage später', 'probleme beim Speichern der Bilder in der Datenbank (mussten in den Supporttermin)', 'den Befehl UPDATE gericht SET bildname = (Name vom bild) WHERE id = ?', 'Am Anfang beim Speichern der Bilder in die Datenbank', 'Supporttermin'],
        15 => ['2 3)', '15 min', '15 min', 'keine','in der index.blade als img src="" den pfad zum Bild angegeben', 'keine', 'keine'],
        16 => ['2 4)', '5 min', '5 min', 'keine', 'Abgefragt ob das Bild existiert, wenn nicht dann den pfad zu missing imgs angegeben', 'keine', 'keine'],
        17 => ['3)', '1 stunden', '4 Stunden', 'Monolog hat sich nicht downloaden lassen, brauchte etwas länger um das zu fixen plus Monolog einzurichten', 'Monolog herunterladen, logdatei einrichten', 'Download schlug fehl', 'Internet'],
        18 => ['4 a)', '15 min', '5 min', 'war einfach', 'CREATE VIEW IF NOT EXISTS view_suppengerichte AS SELECT name FROM gericht WHERE name LIKE %suppe%;', 'keine', 'Vorlesung'],
        19 => ['4 b)', '10 min', '5 min', 'war einfach', 'CREATE VIEW IF NOT EXISTS view_anmeldungen AS SELECT anzahlanmeldungen FROM benutzer ORDER BY anzahlanmeldungen ASC;', 'keine', 'Vorlesung'],
        20 => ['4 c)', '15 min', '1 stunde', 'war komplizierter umzusetzen, sodass ich länger überlegen musste, bis ich auf die lösung kam', 'CREATE VIEW IF NOT EXISTS view_kategoriegerichte_vegetarisch AS
SELECT gericht.name AS gerichtname ,
       kategorie.name AS kategorie
FROM gericht
         JOIN gericht_hat_kategorie ON gericht.id = gericht_hat_kategorie.gericht_id && gericht.vegetarisch IS TRUE
         RIGHT JOIN kategorie ON gericht_hat_kategorie.kategorie_id = kategorie.id;', 'keine', 'Vorlesung'],
        21 => ['5 a)', '15 min', '15 min', 'keine', 'CREATE PROCEDURE AnmeldeCounter(IN email_input VARCHAR(100))
BEGIN
    UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1
    WHERE email = email_input;
end; CREATE PROCEDURE AnzahlfehlerCounter(IN email_input VARCHAR(100))
BEGIN
    UPDATE benutzer SET anzahlfehler = anzahlfehler + 1
    WHERE email = email_input;
end;', 'keine', 'Vorlesung'],
        22 => ['5 b)', '5 min', '5 min', 'keine', 'in der Model die vorherige Inkrementierung ohne die Prozedur mit der neuen Prozedur ersetzt', 'keine', 'keine'],
    ];

function Createtabell(array $TabellenInhalt)
{
    foreach ($TabellenInhalt as $Array) {
        echo '<tr>';
        foreach ($Array as $inhalt) {
            echo '<td>' . $inhalt . '</td>';
        }
        echo '</tr>';
    }
}

?>

<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> dossier </title>
    <style>
        h1 {
            text-align: center;
            color: blue;
            font-size: xxx-large
        }

        table, th, td {
            border: 2px solid black;
            width: 100em;
            overflow: visible;
            border-collapse: collapse;
            font-size: x-large
        }

        th, td {
            text-align: center;
            font-size: x-large;
            padding: 2em
        }

        th {
            font-weight: bold;
            font-size: xx-large
        }

        h1 {
            position: relative
        }
    </style>
</head>
<body>
<h1> Dossier M5 </h1>
<h2> Praktikum DBWT <br> Paul, Ebeling, 3272182 <br> Alan, Tofeq, 3286019 </h2>
<table>
    <tr>
        <th> Aufgabe</th>
        <th> Erwartete Zeit</th>
        <th> Zeit</th>
        <th> Grund der Abweichung</th>
        <th> Gefundene Lösungswege</th>
        <th> Fehlschläge</th>
        <th> Genutzte Quellen</th>
    </tr>
    <?php Createtabell($TabellenInhalt); ?>
</table>
</body>
