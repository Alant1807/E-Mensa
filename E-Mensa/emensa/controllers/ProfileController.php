<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');


class ProfileController
{
    public function profil(): string
    {
        if (isset($_POST['zurueck'])) {
            header('Location: /');
            exit();
        }
        if (isset($_SESSION['login_ok']) && $_SESSION['login_ok'] == true) {
            $data = getUser($_SESSION['email']);
            return view('profil', ['userinfo' => $data]);
        } else {
            return view('Anmeldung');
        }
    }
}