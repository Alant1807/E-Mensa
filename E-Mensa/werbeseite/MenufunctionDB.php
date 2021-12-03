<?php

function menu()
{
    $link = mysqli_connect("127.0.0.1",
        "root",
        "root",
        "emensawerbeseite"

    );
    if (!$link) {
        echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
        exit();
    }

    $sql = "SELECT  gericht.name  AS gerichtname,preis_intern,preis_extern,
        GROUP_CONCAT(allergen.code) AS allergen, GROUP_CONCAT(allergen.name)
        FROM gericht
         LEFT JOIN gericht_hat_allergen
                   on gericht.id = gericht_hat_allergen.gericht_id
         LEFT JOIN allergen ON gericht_hat_allergen.code = allergen.code
        GROUP BY gericht.name asc limit 5";

    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo "Fehler während der Abfrage: ", mysqli_error($link);
        exit();
    }
    // Ausgabe der Tabelle
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>', $row['gerichtname'], '</td>';
        echo '<td>', $row['preis_intern'], '</td>';
        echo '<td>', $row['preis_extern'], '</td>';
        echo '<td>', $row['allergen'], '</td>';
        echo '</tr>';
    }

    mysqli_free_result($result);
    mysqli_close($link);

}

function allergenList()
{
    $link = mysqli_connect("127.0.0.1",
        "root",
        "root",
        "emensawerbeseite"
    );
    if (!$link) {
        echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
        exit();
    }
    $sql = "SELECT  GROUP_CONCAT(allergen.code) AS allergen,
                    GROUP_CONCAT(allergen.name) AS name
            FROM gericht
                LEFT JOIN gericht_hat_allergen
                   ON gericht.id = gericht_hat_allergen.gericht_id
                LEFT JOIN allergen
                   ON gericht_hat_allergen.code = allergen.code
                GROUP BY gericht.name asc LIMIT 5;";
    $result = mysqli_query($link, $sql);

    if (!$result) {
        echo "Fehler während der Abfrage: ", mysqli_error($link);
        exit();
    }

    echo "<h4>Liste der Allergene</h4>";

    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        $allergen = $row['allergen'];
        $ArrayDerAllagenCodes[] = explode(',', $allergen);
        $name = $row['name'];
        $ArrayDerAllagenNamen[] = explode(',',$name);
    }
    $counter = count($ArrayDerAllagenCodes); // Anzahl der Array Elemente

    for($i = 0; $i < $counter; $i++)
    {
        $counter2 = count($ArrayDerAllagenCodes[$i]);
        for($j = 0; $j < $counter2; $j++)
        {
            if($ArrayDerAllagenCodes[$i][$j]) // Wenn Code nicht existiert soll er auch nicht ausgegeben werden
                echo'<li>'.$ArrayDerAllagenCodes[$i][$j].' = '.$ArrayDerAllagenNamen[$i][$j].'</li>';
        }
    }
    echo "</ul>";

    mysqli_free_result($result);
    mysqli_close($link);

}

function getRows()
{
    $link = mysqli_connect("127.0.0.1",
        "root",
        "root",
        "emensawerbeseite"
    );
    if (!$link) {
        echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
        exit();
    }
    $sql = "SELECT name, preis_intern, preis_extern,code FROM gericht,gericht_hat_allergen 
            ORDER BY name 
            LIMIT 5";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo "Fehler während der Abfrage: ", mysqli_error($link);
        exit();
    }

    if ($result = mysqli_query($link, $sql)) {
        $rowcount = mysqli_num_rows($result);// Gibt die anzahl der zeilen an
        printf($rowcount); // Ausgabe von der zeilen anzahl

    }

    mysqli_free_result($result);
    mysqli_close($link);

}