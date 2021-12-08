<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');

class WerbeSeiteController
{
    public function index(RequestData $request)
    {
        $vars = ['gerichte' => db_gericht_select_menu(),
            'allergene' => db_allergenlist()
        ];
        return view('index', $vars);
    }

    public function wunschgericht()
    {
        if (isset($_POST['submit'])) {

            $link = connectdb();

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
        INSERT INTO wunschgericht (gerichtname, erstellungsdatum, beschreibung, ErstellerID)
        VALUES(?,?,?,?)
        ");
            $einfuegen2->bind_param('ssss', $gerichtname, $erstellungsdatum, $beschreibung, $email);
            $einfuegen2->execute();

            unset($_POST);
            header('Location: wunschgericht');

            mysqli_close($link);
        }
        return view('wunschgericht');
    }
}