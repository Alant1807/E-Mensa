<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/login.php');


class ProfileController
{
    public function profil(){
        if($_SESSION['login_ok'] == true){
            $data = getUser($_SESSION['email']);
            return view('profil',['userinfo' => $data]);
        }
        else{
            return view('Anmeldung');
        }
    }
}