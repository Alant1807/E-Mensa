<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

return array(
    '/' => 'WerbeSeiteController@index',
    '/home' => 'HomeController@index',
    '/demo' => 'DemoController@demo',
    '/dbconnect' => 'DemoController@dbconnect',
    '/debug' => 'HomeController@debug',
    '/wunschgericht' => 'WerbeSeiteController@wunschgericht',
    '/anmeldung' => 'AnmeldungController@anmeldung',
    '/anmeldung_verifizieren' => 'AnmeldungController@anmeldung_verifizieren',
    '/registrieren' => 'AnmeldungController@registrieren',
    '/registrieren_verifizieren' => 'AnmeldungController@registrieren_verifizieren',
    '/abmeldung' => 'AnmeldungController@abmeldung',
    '/profil' => 'ProfileController@profil',
    '/zuruecksetzen' => 'ResetController@zuruecksetzen',
    '/reset' => 'ResetController@reset',
    '/checkFormular' => 'WerbeSeiteController@checkFormular',
    '/code' => 'AnmeldungController@code',
    '/entercode' => 'AnmeldungController@entercode',
    '/resetKontowithCode' => 'ResetController@resetKontowithCode',
    '/checkCode' => 'ResetController@checkCode',
    '/bewertung' => 'WerbeSeiteController@bewertung',
    '/bewertungen' => 'WerbeSeiteController@bewertungen',
    '/meinebewertungen' => 'WerbeSeiteController@meinebewertungen',

    // Erstes Beispiel:
    '/m4_6a_queryparameter' => 'ExampleController@m4_6a_queryparameter',
    '/m4' => 'ExampleController@m4_6a_queryparameter',
    '/m4_6b_kategorie' => 'ExampleController@m4_6b_kategorie',
    '/m4_6c_gerichte' => 'ExampleController@m4_6c_gerichte',
    '/m4_6d_layout' => 'ExampleController@m4_6d_layout'
);