<?php
$TabellenInhalt =
    [
        1 => ['1 a)', '', '', '', '', '', ''],
        2 => ['1 b)', '10 min', '10 min', 'keine', 'Table erstellt mit den attributen und ihren nebenbedingungen und datentypen', 'keine', 'keine'],
        3 => ['1 1)', '30 min', '1 stunde', 'wusste nicht wie ich das zuerst umsetzen soll', 'neue route zur bewertung + blade', 'keine', 'keine'],
        4 => ['1 2)', '15 min', '15 min', 'keine', 'neue model namens bewertung.php angelegt, wo ich die bewertung setze', 'keine', 'keine'],
        5 => ['1 3)', '15 min', '5 min', 'war einfach umzusetzen', 'überprüft ob man angemeldet ist, neue tabellen spalte um zur bewertung weitergeleitet zu werden mit der id zum gericht in der URL', 'keine', 'keine'],
        6 => ['1 4)', '1 Stunde', '1 Stunde', 'keine', 'eine Form, wo die Eingaben in den Controller gesendet werden mit $_POST und dann in der Datenbank gespeichert werden', 'keine', 'keine'],
        7 => ['1 5)', '20 min', '20 min', 'keine', 'mit @media 2 Verschiedene CSS Dateien eine für unter und eine für über 600px', 'keine', 'Keine'],
        8 => ['1 6)', '1 Stunde', '50 min', 'Copy und Paste aus der vorherige Aufgabe hats verschnellert', 'neue Blade + Datenbankanfrage um die 30 aktuellsten Bewertungen anzeigen zu lassen', 'keine', 'keine'],
        9 => ['1 7)', '1 Stunde', '3 Stunden', 'Probleme mit der Datenbank gehabt', 'route + blade für meineBewertungen erstellt und eine Datenbank anfrage um die Bewertungen des angemeldeten Users zu bekommen', 'SQL Syntax fehler bei der Datenbankanfrage ', ''],
        10 => ['1 8)', '1 Stunde', '1 Stunde', 'keine', 'das löschen passiert in der datenbank, indem man in der Blade zu meineBewertungen die Bewertungen auswählt und submitted', 'keine', 'keine'],
        11 => ['2 1)', '30 min', '1 Stunde 30 min', 'Hatte Probleme damit die Datenbank über den link zu ändern', 'habe eine Procedure die im Modell in einer funktion aufgerufen wird die im Controller ausgeführt wird und über den link aufgerufen wird', 'Keine', 'Vorlesung'],
        12 => ['2 2)', '0 min', '0 min','In der 2 1) gemacht','keine','Keine', 'Keine'],
        13 => ['2 3)', '5 min', '5 min', 'keine','eine Klasse mit einer if bedingung erstellt so das nur hervorgehobene diese klasse haben', 'keine', 'keine'],
        14 => ['2 4)', '30 min', '25 min', 'Probleme mit CSS', 'habe der über den Werbeseiten Controller in der funktion index die Bewertungen übergeben und eine Tabelle in der index angelegt die in einer for-schleife nach hervorgehobenen bewertungen filtert', 'keine', 'keine'],
        15 => ['3 1)', '5 min', '5 min', 'keine', 'über Composer installiert', 'keine', 'keine'],
        16 => ['3 2)', '5 min', '5 min', 'keine', 'inkludiert und konfiguriert', 'keine', 'Vorlesung'],
        17 => ['3 3) a', '10 min', '10 min', 'keine', 'Gericht::query()->find($gericht_id)', 'keine', 'Vorlesung'],
        18 => ['3 3) b', '20 min', '13 min', 'schnelle umsetzung dank eloquent', '$hervorheben = Bewertung::query()->find($rd->query[hervorheben]); $hervorheben->hervorgehoben ^= 1;
            $hervorheben->save();', 'keine', 'Vorlesung'],
        19 => ['3 3) c', '20 min', '20 min', 'keine', '$removeReview = Bewertung::query()->where(gericht_id,$_POST[delete])->where(kunde,$_SESSION[email]);
                $removeReview->delete();', 'keine', 'Vorlesung'],
        19 => ['3 4)', '5 min', '5 min', 'keine', 'class Gericht in der Model gericht.php erstellt und die tabelle gericht rein konfiguriert', 'keine', 'Vorlesung'],
        20 => ['3 5)', '45 min', '20 min', 'Aufgabe überschätzt', 'Accessor in der Gericht Klasse erstellt und dann preisIntern => Gericht::query()->take(5)->pluck(preis_intern),
            preisExtern => Gericht::query()->take(5)->pluck(preis_extern) in der Index funktion im Controller gemacht um diese in der index blade aufrufen zu können', 'keine', 'Vorlesung/Internet'],
        21 => ['3 6)', '2 Stunden', '6 Stunden', 'speichern in der Datenbank hat Probleme bereitet', 'Mutators in der class Bewertungen erstellt und bei der Instanziierung zugegriffen um Wert transformiert in der Datenbank zu speichern', 'Das Speichern in der Datenbank', 'Vorlesung'],
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
