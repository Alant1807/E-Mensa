<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd)
    {

        $name ="";
        if(!isset($_GET['name'])){
            $name = "Kein Name";
        }
        else{
            $name = $_GET['name'];
        }

        return view('examples.m4_6a_queryparameter', [
            'name'=>$name,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI'] }"
        ]);
    }

    public function m4_6b_kategorie()
    {
        $data = db_kategorie_select_all();

        return view('examples.m4_6b_kategorie', [
            'kategoriename' => $data
        ]);
    }

    public function m4_6c_gerichte()
    {
        $data = db_gericht_select_name_and_intern_price_moreThan2euro();

        return view('examples.m4_6c_gerichte', [
            'eintrag' => $data
        ]);
    }

    public function m4_6d_layout(RequestData $rd)
    {
        if(!isset($_GET['no'])){
            return view('examples.pages.m4_6d_page_1',[]);
        }
        if(isset($_GET['no'])) {
            if ($_GET['no'] == "1") {
                return view('examples.pages.m4_6d_page_1',[]);
            }
            if ($_GET['no'] == "2") {
                return view('examples.pages.m4_6d_page_2',[]);
            }
        }
    }
}


