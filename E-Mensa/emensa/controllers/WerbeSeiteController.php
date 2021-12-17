<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');

class WerbeSeiteController
{
    public function index(RequestData $request)
    {
        $vars = ['gerichte' => db_gericht_select_menu(),
            'allergene' => db_allergenlist()
        ];
        $_SESSION['target'] = "";
        logger()->info('Zugriff auf Hauptseite');
        return view('index', $vars);
    }

    public function wunschgericht()
    {
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

            wgericht($name, $email, $gerichtname, $erstellungsdatum, $beschreibung);
        }
        return view('wunschgericht');
    }
}