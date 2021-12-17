<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');

class AnmeldungController
{
    public function anmeldung()
    {
        $vars = ['msg' => $_SESSION['login_result_message'],
            'emptyuser' => $_SESSION['emptyuser'],
            'emptypassword' => $_SESSION['emptypassword']];
        if (isset($_SESSION['login_result_message']) || isset($_SESSION['emptyuser']) || isset($_SESSION['emptypassword'])) {
            $_SESSION['login_result_message'] = NULL;
            $_SESSION['emptyuser'] = NULL;
            $_SESSION['emptypassword'] = NULL;
        }
        return view('Anmeldung', $vars);
    }

    public function registrieren()
    {
        $vars = ['existUser' => $_SESSION['existUser'],
            'emptyuser' => $_SESSION['emptyuser'],
            'emptypassword' => $_SESSION['emptypassword']];
        if (isset($_SESSION['existUser']) || isset($_SESSION['emptyuser']) || isset($_SESSION['emptypassword'])) {
            $_SESSION['existUser'] = NULL;
            $_SESSION['emptyuser'] = NULL;
            $_SESSION['emptypassword'] = NULL;
        }
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
            if (empty($email) && empty($password)) {
                $_SESSION['emptyuser'] = "Bitte E-Mail eingeben";
                $_SESSION['emptypassword'] = "Bitte Password eingeben";
                header('Location: /registrieren');
            }
            if (!empty($password) && empty($email)) {
                $_SESSION['emptyuser'] = "Bitte E-Mail eingeben";
                header('Location: /registrieren');
            } elseif (empty($password) && !empty($email)) {
                $_SESSION['emptypassword'] = "Bitte Password eingeben";
                header('Location: /registrieren');
            }
            if ($data['email'] == $email && !empty($email)) {
                logger()->warning('failed registration', [$email]);
                $_SESSION['existUser'] = "E-Mail ist schon vergeben";
                header('Location: /registrieren');
            }
            if (isset($_POST['checkadmin']) && $data['email'] != $email && !empty($password)) {
                insertUser($email, $passwordhash, true);
                $_SESSION['login_ok'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['id'];
                $_SESSION['admin'] = $data['admin'];
                $target = $_SESSION['target'];
                logger()->info('register', [$email]);
                logger()->info('Zugriff auf Hauptseite');
                header('Location: /' . $target);
            } else if (!isset($_POST['checkadmin']) && $data['email'] != $email && !empty($password)) {
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
        } elseif ($_POST['back']) {
            logger()->info('Zugriff auf Hauptseite');
            session_destroy();
            header('Location: /');
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
            if (empty($email) && empty($password)) {
                $_SESSION['emptyuser'] = "Bitte E-Mail eingeben";
                $_SESSION['emptypassword'] = "Bitte Password eingeben";
                header('Location: /anmelden');
            }
            if (!empty($password) && empty($email)) {
                $_SESSION['emptyuser'] = "Bitte E-Mail eingeben";
                header('Location: /anmelden');
            } elseif (empty($password) && !empty($email)) {
                $_SESSION['emptypassword'] = "Bitte Password eingeben";
                header('Location: /anmelden');
            }
            if (password_verify($password, $data['passwort']) && $data['email'] == $email) {
                update_user($email, true);
                $_SESSION['login_ok'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['id'];
                $_SESSION['admin'] = $data['admin'];
                logger()->info('login', [$email]);
                logger()->info('Zugriff auf Hauptseite');
                header('Location: /');
            } elseif (!password_verify($password, $data['passwort']) || $data['email'] != $email) {
                update_user($email, false);
                logger()->warning('failed login', [$email]);
                $_SESSION['login_result_message'] = "Benutzername oder Passwort falsch";
                header('Location: /anmeldung');
            }
        } elseif (isset($_POST['back'])) {
            logger()->info('Zugriff auf Hauptseite');
            session_destroy();
            header('Location: /');
        }
    }

    public function abmeldung()
    {
        logger()->info('logout', [$_SESSION['email']]);
        session_destroy();
        header('Location: /');
    }

}