<?php
/**
 * Praktikum DBWT. Autoren:
 * Alan, Tofeq, 3286019
 * Paul, Ebeling, 3272182
 */

function oldmenu()
{
    $menu = [
        0 => ["Rindfleisch mit Bambus, Kaiserschoten und rotem Paprika, dazu Mie Nudeln","3.50€","6.20€", '<img class="bild" src="img/unknown.png">'],
        1 => ["Spinatrisotto mit kleinen Samosateigecken und gemischten Salat","2.90€","5.30€", '<img class="bild" src="img/unknown3.png">'],
        2 => ["Pommes mit Schnitzel","4.30€","8.00€", '<img class="bild" src="img/unknown2.png">'],
        3 => ["wagyu steak","10.00€","20.00€", '<img class="bild" src="img/unknown4.png">'],
    ];


    foreach ($menu as $key => $meal)
        {
            // count und differenz sind Integer mit der anzahl der Elemente im Array meal
            $count = count($meal);
            $differenz = count($meal);

            echo "<tr>";
            // In der schleife wir jedes elements des Array meal als tabellen element aus
            while($differenz != 0)
            {
                echo "<td>".$meal[$count - $differenz]."</td>"; // wenn nur [$count] würden die elemente in der falschen reihenfolge ausgegeben
                $differenz--;
            }
            echo "</tr>";

        }
}



