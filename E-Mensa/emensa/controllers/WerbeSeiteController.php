<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');

class WerbeSeiteController
{
    public function index()
    {
        if (!isset($_SESSION['refresher'])) {
            $_SESSION['refresher'] = 0;
        } else {
            $_SESSION['refresher']++;
        }
        $vars = ['gerichte' => db_gericht_select_menu(),
            'allergene' => db_allergenlist(),
            'refresher' => $_SESSION['refresher'],
            'getrows' => getrowsgerichte(),
            'benutzername_error' => $_SESSION['benutzername_error'],
            'email_error' => $_SESSION['email_error'],
            'checkbox_error' => $_SESSION['checkbox_error'],
            'noerror' => $_SESSION['noerror']
        ];
        if(isset($_SESSION['benutzername_error']) || isset($_SESSION['email_error']) ||
            isset($_SESSION['checkbox_error']) || isset($_SESSION['noerror'])){
            $_SESSION['benutzername_error'] = NULL;
            $_SESSION['email_error'] = NULL;
            $_SESSION['checkbox_error'] = NULL;
            $_SESSION['noerror'] = NULL;
        }
        $_SESSION['target'] = "";
        logger()->info('Zugriff auf Hauptseite');
        return view('index', $vars);
    }

    public function checkFormular(){
        $benutzername = trim($_POST['text'] ?? NULL);
        $email = filter_input(INPUT_POST, 'email');
        $language = filter_input(INPUT_POST,'language');
        $notdomains = ["rcpt.at" . "damnthespam.at", "wegwerfmail.de", "trashmail.de", "trashmail.com"];
        $iferror = false;
        if (empty($benutzername)) {    // wenn benutzer nicht eingetragen
            $_SESSION['benutzername_error'] = "Bitte Benutzername eintragen";
            $iferror = true;
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $benutzername)) {    // auf richtige Eingaben des benutzer überprüfen
            $_SESSION['benutzername_error'] = "Benutzername nicht zugelassen";
            $iferror = true;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {  // wenn email falsch ist
            $_SESSION['email_error'] = "Bitte geben Sie Ihre E-Mail richtig ein";
            $iferror = true;
        } else {
            $domain = explode('@', $email);     // auf domain prüfen
            $mail = array_pop($domain);          // domain teil popen und überprüfen
            if (in_array($mail, $notdomains)) {
                $_SESSION['email_error'] = "Domain nicht zugelassen";
                $iferror = true;
            }
        }
        if (!isset($_POST['checkbox'])) {  // wenn Datenschutzbestimmung nicht gesetzt ist
            $_SESSION['checkbox_error'] = "Bitte Stimmen Sie der Datenschutzbestimmung zu";
            $iferror = true;
        }
        if($iferror){
            header('Location: /');
        }
        if ($iferror == false) {
            insertNewsletter($benutzername,$email,$language);
            $_SESSION['noerror'] = "Registrierung erfolgreich";
            header('Location: /');
        }
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