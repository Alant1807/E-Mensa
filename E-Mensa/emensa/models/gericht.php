<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */

function db_gericht_select_all()
{
    try {
        $link = connectdb();

        $sql = "SELECT id, name, beschreibung FROM gericht ORDER BY name";
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    } catch (Exception $ex) {
        $data = array(
            'id' => '-1',
            'name' => 'Datenbankfehler ' . $ex->getCode(),
            'beschreibung' => $ex->getMessage());
    } finally {
        return $data;
    }

}

function getrowsgerichte()
{
    $link = connectdb();
    $sql = "SELECT name, preis_intern, preis_extern,code FROM gericht,gericht_hat_allergen 
            ORDER BY name 
            LIMIT 5";
    $rowcount = 0;
    if ($result = mysqli_query($link, $sql)) {
        $rowcount = mysqli_num_rows($result);// Gibt die anzahl der zeilen an
    }
    mysqli_close($link);
    return $rowcount;
}

function db_gericht_select_name_and_intern_price_moreThan2euro()
{
    $link = connectdb();

    $sql = "SELECT name,preis_intern FROM gericht WHERE preis_intern > 2 ORDER BY name DESC ";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_gericht_select_menu()
{
    $link = connectdb();

    $sql = "SELECT gericht.name, preis_intern, preis_extern,bildname, GROUP_CONCAT(allergen.code) allergene
                FROM
                    (allergen RIGHT JOIN gericht_hat_allergen ON allergen.code=gericht_hat_allergen.code)
                    RIGHT JOIN gericht ON gericht_hat_allergen.gericht_id=gericht.id
                GROUP BY gericht.name
                LIMIT 5";

    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function db_allergenlist()
{
    $link = connectdb();

    $sql = "SELECT allergen.code,name
                    FROM
                        ((SELECT gericht.id FROM gericht ORDER BY id LIMIT 5) t INNER JOIN gericht_hat_allergen
                        ON t.id=gericht_hat_allergen.gericht_id) 
                        INNER JOIN allergen
                        ON allergen.code=gericht_hat_allergen.code
                    GROUP BY gericht_hat_allergen.code";


    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function wgericht($name,$email,$gerichtname,$erstellungsdatum,$beschreibung,){
    $link = connectdb();

    $einfuegen = $link->prepare("
                 INSERT INTO ersteller (email, name) 
                 VALUES (?, ?)
                    ");
    $einfuegen->bind_param('ss', $email, $name);
    $einfuegen->execute();

    $einfuegen2 = $link->prepare("
        INSERT INTO wunschgericht (gerichtname, erstellungsdatum, beschreibung, ErstellerID)
        VALUES(?,?,?,?)
        ");
    $einfuegen2->bind_param('ssss', $gerichtname, $erstellungsdatum, $beschreibung, $email);
    $einfuegen2->execute();

    mysqli_close($link);
}