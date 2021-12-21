<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');

class ResetController
{
    public function zuruecksetzen()
    {
        $vars = ['failurepass' => $_SESSION['failurepass'],
            'failurerepeatpass' => $_SESSION['failurerepeatpass'],
            'notequalPass' => $_SESSION['notequalPass'],
            'fail_email' => $_SESSION['fail_email'],
            'notequalMail' => $_SESSION['notequalMail']];
        if (isset($_SESSION['failurepass']) || isset($_SESSION['failurerepeatpass'])
            || isset($_SESSION['notequalPass']) || isset($_SESSION['fail_email']) || isset($_SESSION['notequalMail'])) {
            $_SESSION['failurepass'] = NULL;
            $_SESSION['failurerepeatpass'] = NULL;
            $_SESSION['notequalPass'] = NULL;
            $_SESSION['fail_email'] = NULL;
            $_SESSION['notequalMail'] = NULL;
        }
        return view('UpdateUser', $vars);
    }

    public function reset()
    {
        if (isset($_POST['submit'])) {
            $email = trim($_POST['email'] ?? NULL);
            $password = filter_input(INPUT_POST, 'password');
            $repeatpass = filter_input(INPUT_POST, 'repeatpass');
            $fail = false;
            $_SESSION['fail_email'] = NULL;
            $_SESSION['failurepass'] = NULL;
            $_SESSION['failurerepeatpass'] = NULL;
            $_SESSION['notequalPass'] = NULL;
            $_SESSION['notequalMail'] = NULL;
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $repeatpassword_hash = password_hash($repeatpass, PASSWORD_BCRYPT);
            $data = getUser($email);
            if (empty($email) && empty($password) && empty($repeatpass)) {
                $_SESSION['fail_email'] = "Bitte E-Mail eingeben";
                $_SESSION['failurepass'] = "Bitte Password eingeben";
                $_SESSION['failurerepeatpass'] = "Bitte Password wiederholen";
                $fail = true;
            } elseif (!empty($email) && !empty($password) && empty($repeatpass)) {
                $_SESSION['failurerepeatpass'] = "Bitte Password wiederholen";
                $fail = true;
            } elseif (empty($password) && !empty($repeatpass) && !empty($email)) {
                $_SESSION['failurepass'] = "Bitte Password eingeben";
                $fail = true;
            } elseif (empty($email) && !empty($password) && !empty($repeatpass)){
                $_SESSION['fail_email'] = "Bitte E-Mail eingeben";
                $fail = true;
            }
            if ($fail) {
                header('Location: /zuruecksetzen');
            }
            if (!empty($password) && !empty($repeatpass) && !empty($email)) {
                if ($password == $repeatpass && $data['email'] == $email) {
                    resetUser($email, $password_hash);
                    $_SESSION['login_attempts'] = NULL;
                    header('Location: /anmeldung');
                }
                if ($password != $repeatpass && $data['email'] != $email) {
                    $_SESSION['notequalPass'] = "Passwort stimmt nicht überein";
                    $_SESSION['notequalMail'] = "E-Mail stimmt nicht überein";
                    header('Location: /zuruecksetzen');
                } elseif ($password != $repeatpass && $data['email'] == $email){
                    $_SESSION['notequalPass'] = "Passwort stimmt nicht überein";
                    header('Location: /zuruecksetzen');
                } elseif ($password == $repeatpass && $data['email'] != $email){
                    $_SESSION['notequalMail'] = "E-Mail stimmt nicht überein";
                    header('Location: /zuruecksetzen');
                }
            }
        }
    }
}