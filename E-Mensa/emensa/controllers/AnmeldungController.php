<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');

class AnmeldungController
{
    public function anmeldung()
    {
        $vars = ['msg' => $_SESSION['login_result_message']];
        return view('Anmeldung', $vars);
    }

    public function registrieren()
    {
        $vars = ['msg' => $_SESSION['existUser']];
        return view('Registrieren', $vars);
    }

    public function registrieren_verifizieren()
    {
        if (isset($_POST['submit'])) {
            $email = trim($_POST['email'] ?? NULL);
            $password = filter_input(INPUT_POST, 'password');
            $admin = filter_input(INPUT_POST, 'checkadmin');
            $_SESSION['existUser'] = NULL;
            $passwordhash = password_hash($password, PASSWORD_BCRYPT);
            $data = getUser($email);
            if ($data['email'] == $email) {
                logger()->warning('failed registration', [$email]);
                $_SESSION['existUser'] = "E-Mail ist schon vergeben";
                header('Location: /registrieren');
            }
            if (isset($_POST['checkadmin']) && $data['email'] != $email) {
                insertUser($email, $passwordhash, true);
                $_SESSION['login_ok'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['id'];
                $_SESSION['admin'] = $data['admin'];
                $target = $_SESSION['target'];
                logger()->info('register', [$email]);
                logger()->info('Zugriff auf Hauptseite');
                header('Location: /' . $target);
            } else if (!isset($_POST['checkadmin']) && $data['email'] != $email) {
                insertUser($email, $passwordhash, false);
                $_SESSION['login_ok'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['id'];
                $_SESSION['admin'] = $data['admin'];
                $target = $_SESSION['target'];
                logger()->info('register', [$email]);
                logger()->info('Zugriff auf Hauptseite');
                header('Location: /' . $target);
            }
        }
    }

    public function anmeldung_verifizieren()
    {
        if (isset($_POST['submit'])) {
            $email = trim($_POST['email'] ?? NULL);
            $password = filter_input(INPUT_POST, 'password');
            $admin = filter_input(INPUT_POST, 'checkadmin');
            $_SESSION['login_result_message'] = NULL;
            $passwordhash = password_hash($password, PASSWORD_BCRYPT);
            $data = getUser($email);
            if ($passwordhash === $data['passwort']) {
                update_user($email, true);
                $_SESSION['login_ok'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['id'];
                $_SESSION['admin'] = $data['admin'];
                logger()->info('login', [$email]);
                logger()->info('Zugriff auf Hauptseite');
                header('Location: /');
            } else {
                update_user($email, false);
                logger()->warning('failed login', [$email]);
                $_SESSION['login_result_message'] = "Benutzername oder Passwort falsch";
                header('Location: /anmeldung');
            }
        }
    }

    public function abmeldung()
    {
        logger()->info('logout', [$_SESSION['email']]);
        session_destroy();
        header('Location: /');
    }

}