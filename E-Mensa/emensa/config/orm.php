<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$dbconfig = include __DIR__ . '/db.php';

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $dbconfig['host'],
    'database'  => $dbconfig['database'],
    'username'  => $dbconfig['user'],
    'password'  => $dbconfig['password'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
