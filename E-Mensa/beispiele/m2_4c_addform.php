<?php
/**
 * Praktikum DBWT. Autoren:
 * Alan, Tofeq, 3286019
 * Paul, Ebeling, 3272182
 */
function addiere()
{
    $zahl1 = floatval($_POST['zahl1']);
    $zahl2 = floatval($_POST['zahl2']);
    $summe = $zahl1 + $zahl2;
    echo "Die Summe von $zahl1 + $zahl2 ist $summe";
}

function multipliziere()
{
    $zahl1 = floatval($_POST['zahl1']);
    $zahl2 = floatval($_POST['zahl2']);
    $produkt = $zahl1 * $zahl2;
    echo "Das Produkt von $zahl1 * $zahl2 ist $produkt";
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Addieren/Multiplizieren</title>
</head>
<body>
<p>Bitte zwei Zahlen eintragen und das Formular absenden</p>
<form method="post">
    <p>Zahl 1: <input type="number" name="zahl1"></p>
    <p>Zahl 2: <input type="number" name="zahl2"></p>
    <p><input type="submit" name="addiere" value="Addieren">
        <input type="submit" name="multipliziere" value="Multiplizieren">
        <input type="reset">
    </p>
</form>
<?php
if (isset($_POST['addiere']))
    addiere();
else if (isset($_POST['multipliziere']))
    multipliziere();
?>
</body>
