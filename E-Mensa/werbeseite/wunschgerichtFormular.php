<?php

require "wunschgericht.php";

$link = mysqli_connect("127.0.0.1",
    "root",
    "root",
    "emensawebeseite"

);
if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

if (isset($_POST['submit'])) {
    $gerichtname = "";
    if (isset($_POST['mealname'])) {
        $gerichtname = trim($_POST['mealname']);
    }

    $erstellungsdatum = date("Y-m-d H:i:s");

    $beschreibung = "";
    if (isset($_POST['description'])) {
        $beschreibung = trim($_POST['description']);
    }

    $email = "";
    if (isset($_POST['mail'])) {
        $email = trim($_POST['mail']);
    }

    $name = "";
    if (isset($_POST['name'])) {
        $name = trim($_POST['name']);
    }
    if ($name == '') {
        $name = "anonym";
    }

    // speichern

    $einfuegen = $link->prepare("
                 INSERT INTO ersteller (email, name) 
                 VALUES (?, ?)
                    ");
    $einfuegen->bind_param('ss', $email, $name);
    $einfuegen->execute();

    $einfuegen2 = $link->prepare("
        INSERT INTO wunschgericht (gerichtname, erstellungsdatum, beschreibung, Ersteller)
        VALUES(?,?,?,?)
        ");
    $einfuegen2->bind_param('ssss', $gerichtname, $erstellungsdatum, $beschreibung, $email);
    $einfuegen2->execute();

    unset($_POST);
    header('Location:' . $_SERVER['PHP_SELF']);

    mysqli_close($link);
}