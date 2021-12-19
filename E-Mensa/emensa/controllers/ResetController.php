<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');

class ResetController
{
    public function zuruecksetzen()
    {
        $vars = ['failurepass' => $_SESSION['failurepass'],
            'failurerepeatpass' => $_SESSION['failurerepeatpass'],
            'notequalPass' => $_SESSION['notequalPass']];
        if (isset($_SESSION['failurepass']) || isset($_SESSION['failurerepeatpass']) || isset($_SESSION['notequalPass'])) {
            $_SESSION['failurepass'] = NULL;
            $_SESSION['failurerepeatpass'] = NULL;
            $_SESSION['notequalPass'] = NULL;
        }
        return view('UpdateUser', $vars);
    }

    public function reset()
    {
        if (isset($_POST['submit'])) {
            $password = filter_input(INPUT_POST, 'password');
            $repeatpass = filter_input(INPUT_POST, 'repeatpass');
            $fail = false;
            $_SESSION['failurepass'] = NULL;
            $_SESSION['failurerepeatpass'] = NULL;
            $_SESSION['notequalPass'] = NULL;
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $repeatpassword_hash = password_hash($repeatpass, PASSWORD_BCRYPT);
            if (empty($password) && empty($repeatpass)) {
                $_SESSION['failurepass'] = "Bitte Password eingeben";
                $_SESSION['failurerepeatpass'] = "Bitte Password wiederholen";
                $fail = true;
            } elseif (!empty($password) && empty($repeatpass)) {
                $_SESSION['failurerepeatpass'] = "Bitte Password wiederholen";
                $fail = true;
            } elseif (empty($password) && !empty($repeatpass)) {
                $_SESSION['failurepass'] = "Bitte Password eingeben";
                $fail = true;
            }
            if ($fail) {
                header('Location: /zuruecksetzen');
            }
            if (!empty($password) && !empty($repeatpass)) {
                if ($password == $repeatpass) {
                    resetUser($_SESSION['email'], $password_hash);
                    $data = getUser($_SESSION['email']);
                    $_SESSION['login_ok'] = true;
                    $_SESSION['userID'] = $data['id'];
                    header('Location: /');
                }
                if ($password != $repeatpass) {
                    $_SESSION['notequalPass'] = "Passwort stimmt nicht überein";
                    header('Location: /zuruecksetzen');
                }
            }
        }
    }
}