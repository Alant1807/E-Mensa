<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');

class WerbeSeiteController
{
    public function index(RequestData $request)
    {
        $vars = ['gerichte' => db_gericht_select_menu(),
            'allergene' => db_allergenlist()
        ];
        return view('index', $vars);
    }

    public function wunschgericht(){
        return view('wunschgericht');
    }
}