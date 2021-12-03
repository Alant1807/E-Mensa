<?php
$TabellenInhalt =
    [
        1 => ['1 1)', '10 min', '5 min', 'Die Teilaufgabe habe wir überschätzt', 'mit $_SESSION gearbeitet', 'keine', 'php.manual'],
        2 => ['1 2)', '10 min', '5 min', 'Die Teilaufgabe haben wir überschätzt', 'mit txt Dateien gearbeitet', 'Keine', 'php.manual'],
        3 => ['1 3)', '30 min', '15 min', 'Keine', 'Zeilen aus der Tabelle auslesen und ausgeben', 'keine', 'stackoverflow'],
        4 => ['2 1)', '1 min', '1 min', 'Keine', 'Keine', 'Keine', 'Keine'],
        5 => ['2 2)', '1 stunde', '1 stunde 30 min', 'Problem um Daten zu speichern', 'in txt speichern', 'das speichern hat manchmal nicht geklappt', 'keine'],
        6 => ['2 3)', '2 stunden', '6 stunden', 'wussten nicht wie ich angehen soll', 'mit array_multisort,arraycolumn und sort gearbeitet', 'keine Sortierung', 'php.manual/stackoverflow'],
        7 => ['2 4)', '2 stunden', '6 stunden', 'Probleme mit dem Array gehabt', 'stripos und explode', 'falsches/kein filtern', 'stackoverflow/php.manual'],
        8 => ['3 )', '5 min', '5 min', 'keine', 'keine', 'keine', 'keine'],
        9 => ['4 1)', '1 min', '1 min', 'keine', 'keine', 'keine', 'keine'],
        10 => ['4 3)', '30 min', '15 min', 'schneller gedacht', 'create table/verschiedene Datentypen/Primary Key und References', 'Keine', 'Keine'],
        11 => ['4 4)', '5 min', '2 min', 'ging schnell keine Probleme', 'Keine', 'Keine', 'Keine'],
        12 => ['5 1)', '5 min', '5 min', 'keine', '<img src="imgconsole/Screenshot 2021-11-19 203742.jpg">', 'keine', 'Vorlesung'],
        13 => ['5 2)', '5 min', '5 min', 'keine', '<img src="imgconsole/Screenshot 2021-11-19 204420.jpg">', 'keine', 'Vorlesung'],
        14 => ['5 3)', '15 min', '12 min', 'überschätzt', '<img src="imgconsole/Screenshot 2021-11-19 204757.jpg">', 'keine', 'Vorlesung'],
        15 => ['5 4)', '10 min', '10 min', 'keine', '<img src="imgconsole/Screenshot 2021-11-19 204829.jpg">', 'keine', 'Vorlesung'],
        16 => ['5 5)', '5 min', '5 min', 'keine', '<img src="imgconsole/Screenshot 2021-11-19 204906.jpg">', 'keine', 'Vorlesung'],
        17 => ['5 6)', '5 min', '1 min', 'einfach', '<img src="imgconsole/Screenshot 2021-11-19 204957.jpg">', 'keine', 'Vorlesung'],
        18 => ['5 7)', '5 min', '1 min', 'einfach', '<img src="imgconsole/Screenshot 2021-11-19 205034.jpg">', 'keine', 'Vorlesung'],
        19 => ['5 8)', '5 min', '1 min', 'beinfacher als gedacht', '<img src="imgconsole/Screenshot 2021-11-19 205103.jpg">', 'keine', 'Vorlesung'],
        21 => ['5 9)', '5 min', '2 min', 'bisschen nachblättern aber einfach', '<img src="imgconsole/Screenshot 2021-11-19 205222.jpg">', 'keine', 'Vorlesung'],
        22 => ['5 10)', '30 min', '1 stunde 30 min', 'Probleme beim joinen', '<img src="imgconsole/Screenshot 2021-11-19 205259.jpg">', 'falsche Ausgabe', 'Vorlesung'],
        23 => ['5 11)', '30 min', '1 stunde 30 min', 'Probleme beim joinen', '<img src="imgconsole/Screenshot 2021-11-19 205337.jpg">', 'falsche Ausgabe', 'Vorlesung'],
        24 => ['5 12)', '30 min', '1 stunde 30 min', 'Probleme beim joinen', '<img src="imgconsole/Screenshot 2021-11-19 205405.jpg">', 'falsche Ausgabe', 'Vorlesung'],
        25 => ['5 13)', '5 min', '5 min', 'keine', '<img src="imgconsole/Screenshot 2021-11-19 205452.jpg">', 'keine', 'Vorlesung'],
        26 => ['5 14)', '5 min', '5 min', 'keine', '<img src="imgconsole/Screenshot 2021-11-19 205526.jpg">', 'keine', 'Vorlesung'],
        27 => ['5 15)', '10 min', '5 min', 'schneller fertig als gedacht', '<img src="imgconsole/Screenshot 2021-11-19 205607.jpg">', 'keine', 'Vorlesung'],
        28 => ['5 16)', '20 min', '10 min', 'überschätzt die Aufgabe', '<img src="imgconsole/Screenshot 2021-11-19 205904.jpg"> <br> <img src="imgconsole/Screenshot 2021-11-19 210015.jpg"> ', 'keine', 'Vorlesung'],
        29 => ['6)', '1 min', '1 min', 'keine', 'keine', 'keine', 'keine'],
        30 => ['7 1)', '30 min', '15 min', 'hat schnell ohne Probleme funktioniert', 'Tabelle auslesen', 'keine', 'keine'],
        31 => ['7 2)', '30 min', '2 stunden', 'schwierigkeiten die Liste auszugeben', 'mit explode array definieren und dann mit foreach durch iterieren', 'Erzeugung der Liste', 'keine'],
        32 => ['8)', '1 stunde 30 min', '2 Stunden', 'Darstellung der ,,oders" im Diagramm', 'gültige Parameter:', 'keine', 'Vorlesungsmaterialien'],
        33 => ['9)', '1 Stunden', '30 min', 'keine', 'Kommentare und verschönerungen durchgeführt', 'keine', 'keine'],

    ];

function Createtabell(array $TabellenInhalt)
{
    foreach($TabellenInhalt as  $Array)
    {
        echo '<tr>';
        foreach ($Array as $inhalt)
        {
            echo '<td>'.$inhalt.'</td>';
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
    <meta charset ="UTF-8">
    <title> dossier </title>
    <style>
        h1{text-align: center;color: blue; font-size: xxx-large}
        table,th,td {border: 2px solid black;width: 100em;overflow: visible; border-collapse: collapse;font-size: x-large}
        th,td{text-align: center;font-size: x-large;padding: 2em}
        th{font-weight: bold;font-size: xx-large}
        h1{position: relative}
    </style>
</head>
<body>
<h1> Dossier M3 </h1>
<h2> Praktikum DBWT <br> Paul, Ebeling, 3272182 <br> Alan, Tofeq, 3286019 </h2>
<table>
    <tr>
        <th> Aufgabe </th>
        <th> Erwartete Zeit </th>
        <th> Zeit </th>
        <th> Grund der Abweichung </th>
        <th> Gefundene Lösungswege </th>
        <th> Fehlschläge </th>
        <th> Genutzte Quellen </th>
    </tr>
    <?php Createtabell($TabellenInhalt); ?>
</table>
</body>
