<?php
$TabellenInhalt =
    [
        1 => ['1 1)', '10 min', '15 min', 'Habe am anfang Ersteller als Attribut angegeben', 'Ersteller als Entität angegeben', 'keine', 'Support Termin'],
        2 => ['1 2)', '15 min', '25 min', 'Wussten nicht was wir als Fremdschlüssel setzen', 'In lerngruppe gefragt', 'Keine', 'Lerngruppe'],
        3 => ['1 3)', '45 min', '30 min', 'Habe im Internet ein gutes beipiel gefunden an dem man sich orientieren konnte', 'keine', 'keine', 'stackoverflow'],
        4 => ['1 4)', '1 min', '1 min', 'Keine', 'Keine', 'Keine', 'Keine'],
        5 => ['1 5)', '5 min', '5 min', 'keine', 'keine', 'keine', 'keine'],
        6 => ['1 6)', '5 min', '5 min', '', 'Sortiert mit ASC und Limit 5', '', ''],
        7 => ['2', '1 stunden', '30 minuten', 'Die prepared Statements hab ich in der ersten Aufgabe schon gemacht, sodass ich nur XSS machen musste', '$einfuegen = $link->prepare("INSERT INTO ersteller (email, name) VALUES (?, ?)");$einfuegen->bind_param(ss, $email, $name);$einfuegen->execute();$einfuegen2 = $link->prepare("INSERT INTO wunschgericht (gerichtname, erstellungsdatum, beschreibung, ErstellerID)VALUES(?,?,?,?)");$einfuegen2->bind_param(ssss, $gerichtname, $erstellungsdatum, $beschreibung, $email);$einfuegen2->execute(); XSS: echo value=" . htmlspecialchars(Abschicken) . ";', 'keine', 'Vorlesung'],
        8 => ['3', '0', '0', 'keine', 'keine', 'Anderes Team hatte keine Zeit', 'Keine'],
        9 => ['4', '30 min', '30 min', 'keine', 'Keine', 'Keine', 'Keine'],
        10 => ['5 1)', '1 min', '1 min', 'keine', 'keine', 'keine', 'keine'],
        11 => ['5 2)', '1 min', '1 min', 'keine', 'keine', 'keine', 'keine'],
        12 => ['5 3)', '1 min', '1 min', 'keine', 'keine', 'keine', 'keine'],
        13 => ['5 4)', '3 min', '3 min', 'keine', 'keine', 'keine', 'keine'],
        14 => ['5 5)', '5 min', '20 min', 'Wir bekammen immer fehlermeldungen', 'beim build in server den direkten pfad angegeben', 'keine', 'keine'],
        15 => ['6 a)', '15 min', '45 min', 'nicht gewusst, dass man im Controller $_GET aufrufen kann','$name ="";
        if(!isset($_GET[name])){
            $name = "Kein Name";
        }
        else{
            $name = $_GET[name];
        }', 'ohne $_GET gearbeitet', 'Hilfe bekommen von Komilitonen'],
        16 => ['6 b)', '30 min', '30 min', 'einfach', 'Array mit Datenbank-Werten vom Controller in die View gesendet und mit Blade ausgegeben', 'keine', 'Vorlesung'],
        17 => ['6 c)', '15 min', '15 min', 'gleicher Ablauf wie 6 b) deswegen schneller gelöst', 'Array mit Datenbank-Werten vom Controller in die View gesendet und mit Blade ausgegeben', 'keine', 'Vorlesung'],
        18 => ['6 d)', '1 Stunde', '3 Stunden', 'Probleme gehabt, sodass wir die Aufgabe teilweise übersprungen haben, bis wir später die Lösung hatten', 'if(!isset($_GET[no])){
            return view(examples.pages.m4_6d_page_1,[]);
        }
        if(isset($_GET[no])) {
            if ($_GET[no] == "1") {
                return view(examples.pages.m4_6d_page_1,[]);
            }
            if ($_GET[no] == "2") {
                return view(examples.pages.m4_6d_page_2,[]);
            }', 'Die viewname nicht richtig eingegeben', 'Hilfe von Komilitonen'],
        19 => ['7', '4 Stunden', '12 Stunden', 'Die Vermittlung zur View hatte uns Schwierigkeiten gebracht, sodass wir lange dransaßen bis wir am nächsten Tag erst wieder dran gearbeitet haben', 'Im Model die SQL Statements gemacht, Im HomeController die Datenbankwerte in ein Array gespeichert und mittels view an die Index geschickt und in der Index per Blade @extends ein Layout erschaffen, die wir mit @section aufgeteilt haben', 'Die Vermittlung an die view hatte uns Am Anfang schwierigkeiten gebracht', 'Vorlesung/Hilfe von Kommilitonen'],
        20 => ['8 1)', '5 min', '10 min', 'Wusste nihct wie ich es mit ALTER machen kann', 'ALTER TABLE gericht_hat_kategorie ADD UNIQUE (gericht_id, kategorie_id)', 'keine', 'keine'],
        21 => ['8 2)', '5 min', '5 min', 'keine', 'ALTER TABLE gericht ADD INDEX NameID (name)', 'keine', 'keine'],
        22 => ['8 3)', '5 min', '15 min', 'keine', '
        ALTER TABLE gericht_hat_allergen DROP FOREIGN KEY gericht_hat_allergen_ibfk_2;
        ALTER TABLE gericht_hat_allergen
            ADD CONSTRAINT gericht_hat_allergen_ibfk_2
                FOREIGN KEY (gericht_id)
                    REFERENCES gericht (id)
                    ON DELETE CASCADE;            
        ALTER TABLE gericht_hat_kategorie DROP FOREIGN KEY gericht_hat_kategorie_ibfk_1;     
        ALTER TABLE gericht_hat_kategorie
            ADD CONSTRAINT gericht_hat_kategorie_ibfk_1
                FOREIGN KEY (gericht_id)
                    REFERENCES gericht (id)
                    ON DELETE CASCADE'
            , 'keine', 'Lerngruppe'],
        27 => ['8 4)', '5 min', '5 min', 'keine', '
        ALTER TABLE gericht_hat_kategorie  DROP FOREIGN KEY gericht_hat_kategorie_ibfk_2;

ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT gericht_hat_kategorie_ibfk_2
        FOREIGN KEY (kategorie_id)
            REFERENCES kategorie (id)
            ON DELETE RESTRICT;

ALTER TABLE kategorie DROP FOREIGN KEY kategorie_ibfk_1;

ALTER TABLE kategorie
    ADD CONSTRAINT kategorie_ibfk_1
        FOREIGN KEY (eltern_id)
            REFERENCES kategorie (id)
            ON DELETE RESTRICT;', 'keine', '3)'],
        28 => ['8 5)', '5 min', '5 min', 'keine', '
        ALTER TABLE gericht_hat_allergen   DROP FOREIGN KEY gericht_hat_allergen_ibfk_1;

ALTER TABLE gericht_hat_allergen
    ADD CONSTRAINT gericht_hat_allergen_ibfk_1
        FOREIGN KEY (code)
            REFERENCES allergen (code)
            ON UPDATE CASCADE;', 'keine', '3) und 4)'],
        29 => ['8 6)', '3 min', '3 min', 'keine', 'ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT PRIMARY KEY (gericht_id, kategorie_id);', 'keine', 'keine'],


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
<h1> Dossier M3 </h1>
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
