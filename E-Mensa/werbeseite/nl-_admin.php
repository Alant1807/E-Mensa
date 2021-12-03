<?php

session_start();

const GET_PARAM_SERACH_NAME = 'Suche';
const GET_PARAM_SORT_NAME = 'sortname';
const GET_PARAM_SORT_MAIL = 'sortmail';

$file = fopen('./Newsletter_Anmeldungen.txt', 'r');
$arrayuser = [];
$counter = 0;
while (!feof($file)) {
    $arrayuser[$counter] = fgets($file, 1024);
    $counter++;
}
$explodeArray = [];
$count = 0;
while ($count != (count($arrayuser) - 1)) {
    $explodeArray[] = explode('§', $arrayuser[$count]);  // Array exploden um Teile nach dem seperator § zu speichern
    $count++;
}

function createTable(array $ArrayUser)  // Tabelle wird dynamisch erzeugt
{
    $counter = 0;
    foreach ($ArrayUser as $array) {
        if (is_array($array)) {
            echo '<tr>';
            echo '<td>' . $array[$counter] . '</td>';
            echo '<td>' . $array[$counter + 1] . '</td>';
            echo '<td>' . $array[$counter + 2] . '</td>';
            echo '<td>' . $array[$counter + 3] . '</td>';
            echo '</tr>';
        }
    }
}

$showName = [];
if (!empty($_GET[GET_PARAM_SERACH_NAME])) {        // Filtern nach Name
    $cnt = 0;
    $searchTerm = $_GET[GET_PARAM_SERACH_NAME];
    foreach ($explodeArray as $array) {
        if (stripos($array[$cnt], $searchTerm) !== false) {   // case-sensitivie
            $showName[] = $array;            // gesuchte Eingabe hier eingespeichert
        }
    }
} else {
    $showName = $explodeArray;
}

if (!empty($_GET[GET_PARAM_SORT_MAIL])) {       // Sortieren nach Mail
    $cnt2 = 1;
    foreach ($showName as $sort) {
        $sort = array_column($showName, $cnt2);  // spalte Email wird angesprochen im Array
        array_multisort($sort, SORT_ASC, $showName);  // sortiere aufsteigend nach Email
        sort($sort);
    }
}

if (!empty($_GET[GET_PARAM_SORT_NAME])) {  // Sortiere nach Name
    $cnt2 = 0;
    foreach ($showName as $sort) {
        $sort = array_column($showName, $cnt2);     // Spalte Name wird angesprochen
        array_multisort($sort, SORT_ASC, $showName);  // Sortiere aufsteigend nach Name
        sort($sort);
    }
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Newsletter-Anmeldungen</title>
    <style>
        h1 {
            font-size: xx-large;
        }

        tr, td {
            padding: 1em;
        }

        table, th, td {
            border: 1px black solid;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<main>
    <h1>Newsletter-Anmeldungen</h1>
    <div>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="Suche" placeholder="Suche">
            <input type="submit" value="Suche">
            <input type="submit" name="sortname" value="Sortieren nach Name">
            <input type="submit" name="sortmail" value="Sortieren nach Email">
        </form>
    </div>
    <div>
        <table class="users">
            <thead>
            <tr>
                <td>Name</td>
                <td>E-Mail</td>
                <td>Sprache</td>
                <td>Datenschutzbestimmung</td>
            </tr>
            </thead>
            <tbody>
            <?php createTable($showName); ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>



