<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');

class AnmeldungController
{
    public function anmeldung()
    {
        $vars = ['msg' => $_SESSION['login_result_message'],
            'emptyuser' => $_SESSION['emptyuser'],
            'emptypassword' => $_SESSION['emptypassword'],
            'failedlogin' => $_SESSION['failedlogin'],
            'login_fail_admin' => $_SESSION['login_fail_admin']];
        if (isset($_SESSION['login_result_message']) || isset($_SESSION['emptyuser'])
            || isset($_SESSION['emptypassword']) || isset($_SESSION['login_fail_admin'])) {
            $_SESSION['login_result_message'] = NULL;
            $_SESSION['emptyuser'] = NULL;
            $_SESSION['emptypassword'] = NULL;
            $_SESSION['login_fail_admin'] = NULL;
        }
        return view('Anmeldung', $vars);
    }

    public function registrieren()
    {
        $vars = ['existUser' => $_SESSION['existUser'],
            'emptyuser' => $_SESSION['emptyuser'],
            'emptypassword' => $_SESSION['emptypassword'],
            'failedregister' => $_SESSION['failedregister']];
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
            $_SESSION['failedregister'] = false;
            $passwordhash = password_hash($password, PASSWORD_BCRYPT);
            $data = getUser($email);
            if (empty($email) && empty($password)) {
                $_SESSION['emptyuser'] = "Bitte E-Mail eingeben";
                $_SESSION['emptypassword'] = "Bitte Password eingeben";
                $_SESSION['failedregister'] = true;
            }
            if (!empty($password) && empty($email)) {
                $_SESSION['emptyuser'] = "Bitte E-Mail eingeben";
                $_SESSION['failedregister'] = true;
            } elseif (empty($password) && !empty($email)) {
                $_SESSION['emptypassword'] = "Bitte Password eingeben";
                $_SESSION['failedregister'] = true;
            }
            if ($data['email'] == $email && !empty($email)) {
                logger()->warning('failed registration', [$email]);
                $_SESSION['existUser'] = "E-Mail ist schon vergeben";
                $_SESSION['failedregister'] = true;
            }
            if ($_SESSION['failedregister'] == true) {
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
            $loginFailed = false;
            $_SESSION['failedlogin'] = false;
            if ($admin == "on") {
                $admin = 1;
            } elseif ($admin == NULL) {
                $admin = 0;
            }
            if (empty($email) && empty($password)) {
                $_SESSION['emptyuser'] = "Bitte E-Mail eingeben";
                $_SESSION['emptypassword'] = "Bitte Password eingeben";
                $_SESSION['failedlogin'] = true;
            }
            if (!empty($password) && empty($email)) {
                $_SESSION['emptyuser'] = "Bitte E-Mail eingeben";
                $_SESSION['failedlogin'] = true;
            } elseif (empty($password) && !empty($email)) {
                $_SESSION['emptypassword'] = "Bitte Password eingeben";
                $_SESSION['failedlogin'] = true;
            }
            if (password_verify($password, $data['passwort']) && $data['email'] == $email && $data['admin'] == $admin) {
                update_user($email, true);
                $_SESSION['login_ok'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['id'];
                $_SESSION['admin'] = $data['admin'];
                logger()->info('login', [$email]);
                logger()->info('Zugriff auf Hauptseite');
                header('Location: /');
            } elseif (!password_verify($password, $data['passwort']) || $data['email'] != $email) {
                logger()->warning('failed login', [$email]);
                $_SESSION['login_result_message'] = "Benutzername oder Passwort falsch";
                $_SESSION['failedlogin'] = true;
            }
            if (!password_verify($password, $data['passwort']) && $data['email'] == $email && !empty($email)) {
                $_SESSION['email'] = $email;
                $_SESSION['failedlogin'] = true;
                $loginFailed = true;
            }
            if ($data['admin'] != $admin) {
                if ($data['admin'] == 1 && ($admin == 0)) {
                    $_SESSION['login_fail_admin'] = "Sie müssen sich als Admin anmelden";
                    $_SESSION['failedlogin'] = true;
                } elseif ($data['admin'] == 0 && ($admin == 1)) {
                    $_SESSION['login_fail_admin'] = "Sie dürfen sich nicht als Admin anmelden";
                    $_SESSION['failedlogin'] = true;
                }
            }
            if ($_SESSION['failedlogin'] == true) {
                update_user($email, false);
                header('Location: /anmeldung');
            }
            if ($loginFailed) {
                $_SESSION['login_attempts'] += 1;
            }
            if ($_SESSION["login_attempts"] > 2) {
                header('Location: /anmeldung');
            }
        }
        if ($_POST['reset']) {
            header('Location: /zuruecksetzen');
        }
    }

    public function abmeldung()
    {
        logger()->info('logout', [$_SESSION['email']]);
        session_destroy();
        header('Location: /');
    }
}