<?php
/**
 * Praktikum DBWT. Autoren:
 * Alan, Tofeq, 3286019
 * Paul, Ebeling, 3272182
 */

if (isset($_POST['submit'])) {
    $benutzername = trim($_POST['text'] ?? NULL);
    $email = filter_input(INPUT_POST, 'email');
    $language = filter_input(INPUT_POST,'language');
    $notdomains = ["rcpt.at" . "damnthespam.at", "wegwerfmail.de", "trashmail.de", "trashmail.com"];
    $iferror = false;
    $successful = false;
    if (empty($benutzername)) {    // wenn benutzer nicht eingetragen
        $benutzername_error = "Bitte Benutzername eintragen";
        $iferror = true;
        $successful = true;
    }
    if (!preg_match("/^[a-zA-Z0-9]*$/", $benutzername)) {    // auf richtige Eingaben des benutzer überprüfen
        $benutzername_error = "Benutzername nicht zugelassen";
        $iferror = true;
        $successful = true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {  // wenn email falsch ist
        $email_error = "Bitte geben Sie Ihre E-Mail richtig ein";
        $iferror = true;
        $successful = true;
    } else {
        $domain = explode('@', $email);     // auf domain prüfen
        $mail = array_pop($domain);          // domain teil popen und überprüfen
        if (in_array($mail, $notdomains)) {
            $email_error = "Domain nicht zugelassen";
            $iferror = true;
            $successful = true;
        }
    }
    if (!isset($_POST['checkbox'])) {  // wenn Datenschutzbestimmung nicht gesetzt ist
        $checkbox_error = "Bitte Stimmen Sie der Datenschutzbestimmung zu";
        $iferror = true;
        $successful = true;
    }
    if ($iferror == false) {
        $noerror = "Registrierung erfolgreich";

    }
    if ($successful == false) {
        $count = file_get_contents('erfolgreicheAnmeldungen.txt');  // Anzahl der Newsletter-Anmeldungen speichern
        $count++;       // inkrementieren
        file_put_contents('erfolgreicheAnmeldungen.txt', $count);    // aktualisieren
    }
}

include('index.php');