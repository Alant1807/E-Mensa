<?php
$link=mysqli_connect("127.0.0.1", // Host der Datenbank
    "root", // Benutzername zur Anmeldung
    "Pepito_MariaDB", // Passwort
    "emensawerbeseite" // Auswahl der Datenbanken (bzw. des Schemas)
// optional Port der Datenbank
);
if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}
$sql = "SELECT id, name, beschreibung FROM gericht";
$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage: ", mysqli_error($link);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        table{display: table;border: 2px solid black}
        table, th, td {border: 1px solid black;border-collapse: collapse;}
    </style>

</head>

<body>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>beschreibung</th>
    </tr>
    <tbody> <?php
    while ($row = mysqli_fetch_assoc($result))
    {
        echo '<tr>';
        echo '<td>', $row['id'], '</td>';
        echo '<td>', $row['name'], '</td>';
        echo '<td>', $row['beschreibung'], '</td>';
        echo '</tr>';
    }

    mysqli_free_result($result);
    mysqli_close($link);
    ?>
    </tbody>
    </thead>
</table>


</body>


