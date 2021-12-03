<?php
/**
 * Praktikum DBWT. Autoren:
 * Alan, Tofeq, 3286019
 * Paul, Ebeling, 3272182
 */
$ip = $_SERVER['REMOTE_ADDR'];
$sname = $_SERVER['SERVER_NAME'];
$sadd = $_SERVER['SERVER_ADDR'];


$file = fopen('C:\Users\alant\PhpstormProjects\Meilenstein 2\beispiele/accesslog.txt','a');

fwrite($file,"Datum/Uhrzeit: ".date('d-m-y H:i:s')." IP: $ip "." Server name: $sname "." Server-Addr: $sadd "."\r\n");

fclose($file);

$file = fopen('C:\Users\alant\PhpstormProjects\Meilenstein 2\beispiele/accesslog.txt','r');

while(! feof($file)){
    $zeile = fgets($file);
    echo $zeile . "<br>";
}

fclose($file);