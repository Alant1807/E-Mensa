<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */

class Gericht extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'gericht';

    function getPreisInternAttribute($preis_intern): string
    {
        return number_format($preis_intern, 2);
    }

    function getPreisExternAttribute($preis_extern): string
    {
        return number_format($preis_extern, 2);
    }

    function setAttributeVegan($value)
    {
        $acceptedvaluesTrue = ['yes', 'ja'];
        $acceptedvaluesFalse = ['no', 'nein'];
        $str = strtolower($value);
        $str = str_replace(" ", "", $str);
        if (in_array($str, $acceptedvaluesTrue)) {
            $this->attributes['vegan'] = true;
        }
        if (in_array($str, $acceptedvaluesFalse)) {
            $this->attributes['vegan'] = false;
        }
    }

    function setAttributeVegetarisch($value)
    {
        $acceptedvaluesTrue = ["yes", "ja"];
        $acceptedvaluesFalse = ["no", "nein"];
        $str = strtolower($value);
        $str = str_replace(" ", "", $str);
        if (in_array($str, $acceptedvaluesTrue)) {
            $this->attributes['vegetarisch'] = true;
        }
        if (in_array($str, $acceptedvaluesFalse)) {
            $this->attributes['vegetarisch'] = false;
        }
    }
}


function db_gericht_select_all(): array
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

function getrowsgerichte(): int|string
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

function db_gericht_select_name_and_intern_price_moreThan2euro(): array
{
    $link = connectdb();

    $sql = "SELECT name,preis_intern FROM gericht WHERE preis_intern > 2 ORDER BY name DESC ";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_gericht_select_menu(): array
{
    $link = connectdb();

    $sql = "SELECT gericht.*, GROUP_CONCAT(allergen.code) allergene
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

function db_allergenlist(): array
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

function wgericht($id,$gerichtname,$beschreibung,$erstellungsdatum,$setvegan,$setvegetarisch,$preisIntern,$preisExtern){
    $link = connectdb();
    mysqli_begin_transaction($link);
    $statement = mysqli_stmt_init($link);
    mysqli_stmt_prepare($statement, "INSERT INTO gericht (id, name, beschreibung, erfasst_am, vegetarisch, vegan, preis_intern, preis_extern, bildname) VALUES (?,?,?,?,?,?,?,?,'00_image_missing.jpg')");
    mysqli_stmt_bind_param($statement, 'isssssdds', $id, $gerichtname,$beschreibung,$erstellungsdatum,$setvegan,$setvegetarisch,$preisIntern,$preisExtern);
    mysqli_stmt_execute($statement);
    mysqli_commit($link);
    mysqli_close($link);
}