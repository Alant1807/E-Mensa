<?php
/**
 * Praktikum DBWT. Autoren:
 * Alan, Tofeq, 3286019
 * Paul, Ebeling, 3272182
 */
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];

function notWinner(array $famousMeals)
{
    $Winningyears = [];
    foreach ($famousMeals as $Index => $famousMeal)
    {
        foreach ($famousMeal as $name => $meal)
        {
            if(is_array($meal))
            {
                foreach ($meal as $year)
                {
                    $Winningyears[] = $year;
                }
            }
            else
                $Winningyears[] = $meal;
        }
    }
    $last = $Winningyears[count($Winningyears)-1];
    echo "<br>" . "Die Jahre, wo es keine Gewinner gibt sind: ";
    while($last != 1999)
    {
        $Vorkommen = false;
        foreach ($Winningyears as $Winningyear)
        {
            if($Winningyear == $last)
                $Vorkommen = true;


        }
        if($Vorkommen == false)
        {
            echo $last;
            if($last != 2000)
                echo ", ";
        }
        $last--;
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        ol>li:not(:first-child){
            padding-top: 0.5em;
        }
        li,a{
            padding-left: 0.5em;
        }
    </style>
</head>
<body>
<ol>
<?php
sort($famousMeals, SORT_NUMERIC);
foreach ($famousMeals as $Index => $famousMeal)
{
    foreach ($famousMeal as $name => $meal)
    {
        if($name == 'name')
        {
            echo "<li>".$meal."</li>";
        }
        else
        {
            if(is_array($meal))
            {
                echo '<a>';
                foreach ($meal as $year)
                {
                    echo $year.", ";
                }
                echo '</a>';
            }
            else
            {
                echo '<a>' . $meal . '</a>';
            }
        }

    }
}
echo "<br>";
notWinner($famousMeals);
?>
</ol>
</body>
</html>