<?php
$TabellenInhalt =
    [
        1 => ['1 a)', '', '', '', '', '', ''],
        2 => ['1 b)', '', '', '', '', '', ''],
        3 => ['1 c)', '', '', '', '', '', ''],
        4 => ['1 1)', '', '', '', '', '', ''],
        5 => ['1 2)', '', '', '', '', '', ''],
        6 => ['1 3)', '', '', '', '', '', ''],
        7 => ['1 4)', '', '', '', '', '', ''],
        8 => ['1 5)', '20 min', '20 min', 'keine', 'mit @media 2 Verschiedene CSS Dateien eine für unter und eine für über 600px', 'keine', 'Keine'],
        9 => ['1 6)', '', '', '', '', '', ''],
        10 => ['1 7)', '', '', '', '', '', ''],
        11 => ['1 8)', '', '', '', '', '', ''],
        12 => ['1 9)', '', '', '', '', '', ''],
        13 => ['2 1)', '30 min', '1 Stunde 30 min', 'Hatte Probleme damit die Datenbank über den link zu ändern', 'habe eine Procedure die im Modell in einer funktion aufgerufen wird die im Controller ausgeführt wird und über den link aufgerufen wird', 'Keine', 'Vorlesung'],
        14 => ['2 2)', '0 min', '0 min','In der 2 1) gemacht','keine','Keine', 'Keine'],
        15 => ['2 3)', '5 min', '5 min', 'keine','eine Klasse mit einer if bedingung erstellt so das nur hervorgehobene diese klasse haben', 'keine', 'keine'],
        16 => ['2 4)', '30 min', '25 min', 'Probleme mit CSS', 'habe der über den Werbeseiten Controller in der funktion index die Bewertungen übergeben und eine Tabelle in der index angelegt die in einer for-schleife nach hervorgehobenen bewertungen filtert', 'keine', 'keine'],
        17 => ['3 1)', '', '', '', '', '', ''],
        18 => ['3 2)', '', '', '', '', '', ''],
        19 => ['3 3) a', '', '', '', '', '', ''],
        20 => ['3 3) b', '', '', '', '', '', ''],
        21 => ['3 4)', '', '', '', '', '', ''],
        22 => ['3 5)', '', '', '', '', '', ''],
        23 => ['3 6)', '', '', '', '', '', ''],
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
