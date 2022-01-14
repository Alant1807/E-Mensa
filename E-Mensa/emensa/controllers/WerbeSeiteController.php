<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/bewertung.php');

class WerbeSeiteController
{
    public function index(): string
    {
        if (!isset($_SESSION['refresher'])) {
            $_SESSION['refresher'] = 0;
        } else {
            $_SESSION['refresher']++;
        }
        $vars = ['gerichte' => db_gericht_select_menu(),
            'allergene' => db_allergenlist(),
            'bewertungen' => get_Bewertungen(),
            'refresher' => $_SESSION['refresher'] ?? NULL,
            'getrows' => getrowsgerichte(),
            'preisIntern' => Gericht::query()->take(5)->pluck('preis_intern'),
            'preisExtern' => Gericht::query()->take(5)->pluck('preis_extern'),
            'benutzername_error' => $_SESSION['benutzername_error'] ?? NULL,
            'email_error' => $_SESSION['email_error'] ?? NULL,
            'checkbox_error' => $_SESSION['checkbox_error'] ?? NULL,
            'noerror' => $_SESSION['noerror'] ?? NULL,
            'newsletteranmeldungen' => $_SESSION['newsletteranmeldungen'] ?? NULL,
            'existemail' => $_SESSION['existemail'] ?? NULL
        ];
        if (isset($_SESSION['benutzername_error']) || isset($_SESSION['email_error']) ||
            isset($_SESSION['checkbox_error']) || isset($_SESSION['noerror']) || isset($_SESSION['existemail'])) {
            $_SESSION['benutzername_error'] = NULL;
            $_SESSION['email_error'] = NULL;
            $_SESSION['checkbox_error'] = NULL;
            $_SESSION['noerror'] = NULL;
            $_SESSION['existemail'] = NULL;
        }
        if (isset($_SESSION['login_ok'])) {
            logger()->info('Zugriff auf Hauptseite', [$_SESSION['email']]);
        } else {
            logger()->info('Zugriff auf Hauptseite ohne Anmeldung/Registrierung');
        }
        return view('index', $vars);
    }

    public function bewertung(RequestData $rd): string
    {
        $gericht_id = $rd->query['gerichtid'] ?? 1;
        if (isset($_POST['back'])) {
            header('Location: /');
        }
        if (isset($_POST['submit'])) {
            Set_Bewertungen($_POST);
            header('Location: /meinebewertungen');
        }
        if (isset($_SESSION['login_ok'])) {
            $vars = ['gericht' => Gericht::query()->find($gericht_id)];
            return view('Bewertung', $vars);
        }
        return view('Anmeldung');
    }

    public function bewertungen(RequestData $rd): string
    {
        if (isset($_POST['back'])) {
            header('Location: /');
        }
        if (isset($rd->query['hervorheben']) && $_SESSION['admin'] == true) {
            $hervorheben = Bewertung::query()->find($rd->query['hervorheben']);
            $hervorheben->hervorgehoben ^= 1;
            $hervorheben->save();
        }
        $vars = ['bewertungen' => get_Bewertungen()];
        return view('Bewertungen', $vars);
    }

    public function meinebewertungen()
    {
        if (isset($_POST['back'])) {
            header('Location: /');
        }
        if (isset($_SESSION['login_ok'])) {
            $vars = ['bewertungen' => get_user_Bewertungen($_SESSION['email'])];
            if (isset($_POST['submitdelete'])) {
                foreach ($_POST['delete'] as $deleteMeal) {
                    $removeReview = Bewertung::query()->where('id', $deleteMeal)->where('kunde', $_SESSION['email']);
                    $removeReview->delete();
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                return view('meineBewertungen', $vars);
            }
            return view('meineBewertungen', $vars);
        }
    }

    public function checkFormular()
    {
        $benutzername = trim($_POST['text'] ?? NULL);
        $email = filter_input(INPUT_POST, 'email');
        $language = filter_input(INPUT_POST, 'language');
        $notdomains = ["rcpt.at" . "damnthespam.at", "wegwerfmail.de", "trashmail.de", "trashmail.com"];
        $_SESSION['newsletteranmeldungen'] = 0;
        $iferror = false;
        $successful = true;
        $data = getNewsletteruser($email);
        if (empty($benutzername)) {    // wenn benutzer nicht eingetragen
            $_SESSION['benutzername_error'] = "Bitte Benutzername eintragen";
            $iferror = true;
            $successful = false;
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $benutzername)) {    // auf richtige Eingaben des benutzer überprüfen
            $_SESSION['benutzername_error'] = "Benutzername nicht zugelassen";
            $iferror = true;
            $successful = false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {  // wenn email falsch ist
            $_SESSION['email_error'] = "Bitte geben Sie Ihre E-Mail richtig ein";
            $iferror = true;
            $successful = false;
        } else {
            $domain = explode('@', $email);     // auf domain prüfen
            $mail = array_pop($domain);          // domain teil popen und überprüfen
            if (in_array($mail, $notdomains)) {
                $_SESSION['email_error'] = "Domain nicht zugelassen";
                $iferror = true;
                $successful = false;
            }
        }
        if ($email == $data['email']) {
            $_SESSION['existemail'] = "E-Mail ist schon vergeben";
            $iferror = true;
            $successful = false;
        }
        if (!isset($_POST['checkbox'])) {  // wenn Datenschutzbestimmung nicht gesetzt ist
            $_SESSION['checkbox_error'] = "Bitte Stimmen Sie der Datenschutzbestimmung zu";
            $iferror = true;
            $successful = false;
        }
        if ($iferror) {
            header('Location: /');
        }
        if ($iferror == false) {
            insertNewsletter($benutzername, $email, $language);
            $_SESSION['noerror'] = "Registrierung erfolgreich";
        }
        if ($successful == true) {
            $_SESSION['newsletteranmeldungen']++;
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

            $erstellungsdatum = date("Y-m-d");

            $beschreibung = "";
            if (isset($_POST['description'])) {
                $beschreibung = trim($_POST['description']);
            }

            $_SESSION['setVegan'] = NULL;
            if (isset($_POST['vegan'])) {
                $_SESSION['setVegan'] = trim($_POST['vegan']);
            }

            $_SESSION['setVegetarisch'] = NULL;
            if (isset($_POST['vegetarisch'])) {
                $_SESSION['setVegetarisch'] = trim($_POST['vegetarisch']);
            }

            $double_value_preisIntern = 0.0;
            $setPreisIntern = "";
            if (isset($_POST['preisIntern'])) {
                $setPreisIntern = trim($_POST['preisIntern']);
                $double_value_preisIntern = floatval($setPreisIntern);
            }

            $double_value_preisExtern = 0.0;
            $setPreisExtern = "";
            if (isset($_POST['preisExtern'])) {
                $setPreisExtern = trim($_POST['preisExtern']);
                $double_value_preisExtern = floatval($setPreisExtern);
            }
            wgericht(55, $gerichtname, $beschreibung, $erstellungsdatum, $double_value_preisIntern, $double_value_preisExtern);
            header('Location: /setVeganorVegetarisch');
        }
        return view('wunschgericht');
    }

    public function setVeganorVegetarisch(): string
    {
        $insertvegetarisch = Gericht::query()->find(55);
        $insertvegan = Gericht::query()->find(55);
        $insertvegetarisch->vegetarisch = $_SESSION['setVegetarisch'];
        $insertvegan->vegan = $_SESSION['setVegan'];
        $insertvegetarisch->save();
        $insertvegan->save();
        return view('wunschgericht');
    }
}