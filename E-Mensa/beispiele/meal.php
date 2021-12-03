<?php
/**
 * Praktikum DBWT. Autoren:
 * Alan, Tofeq, 3286019
 * Paul, Ebeling, 3272182
 */
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION = 'description_text';

/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch', // Komma hinzugefügt
    17 => 'Milch'
]; // Array von Strings

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => 11, 13,
    'amount' => 42            // Number of available meals öffnende Klammer entfernt
];

$txts = [
    $meal['name'] => 'Sweet potato bags filled with cream cheese and herbs',
    $meal['description'] => 'The sweet potatoes are carefully cut open and the cream cheese is filled in',
];

$translateallergens = [
    $allergens[11] => 'Gluten',
    $allergens[12] => 'Crustaceans',
    $allergens[13] => 'Eggs',
    $allergens[14] => 'Fish',
    $allergens[17] => 'Milk'
];

$ratings = [
    ['text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2],
    ['text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4],
    ['text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4],
    ['text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (stripos($rating['text'], $searchTerm) !== false) { // stropos in stripos umgewandelt
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings): float // schlüsselwort function hinzugefügt
{
    $sum = 0; // 1 in 0
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / (count($ratings));
    }
    return $sum;
}

$states = [
    'de' => 'en',
    'en' => 'de'
];

$display = 'de'; // dies ist der Initialzustand

if (!empty($_GET['sprache'])) {
    // wir nehmen nur 'de' oder 'en an
    if (in_array($_GET['sprache'], $states)) {
        $display = $_GET['sprache'];
    }
}

$link = '?sprache=' . $states[$display]; // Gegenteil in den Link
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>
        <?php
        if ($states[$display] == 'en')
            echo "Gericht: " . $meal['name'];
        else
            echo "Meal: " . $txts[$meal['name']];
        ?>
    </title>
    <style type="text/css">
        * {
            font-family: Arial, serif;
        }

        .rating {
            color: darkgray;
        }
    </style>
</head>

<body>
<a href="<?php echo $link; ?>">Sprache ändern!</a>

<h1>
    <?php
    if ($states[$display] == 'en')
        echo "Gericht: " . $meal['name'];
    else
        echo "Meal: " . $txts[$meal['name']];
    ?>
</h1>
<p><?php
    if (!empty($_GET[GET_PARAM_SHOW_DESCRIPTION])) {
        if ($GET_PARAM_SHOW_DESCRIPTION = 1) {
            if ($states[$display] == 'en')
                echo "Beschreibung: " . $meal['description'];
            else
                echo "Description: " . $txts[$meal['description']];
        }
    }
    ?>
</p>
<p>
    <?php
    if ($states[$display] == 'en')
        echo "Preis intern: " . number_format($meal['price_intern'], 2) . "€";
    else
        echo "Price internal: " . number_format($meal['price_intern'], 2) . "€";
    ?>
</p>
<p><?php
    if ($states[$display] == 'en')
        echo "Preis extern: " . number_format($meal['price_extern'], 2) . "€";
    else
        echo "Price external: " . number_format($meal['price_extern'], 2) . "€";
    ?>
</p>
<h1>
    <?php
    if ($states[$display] == 'en')
        echo "Bewertungen (Insgesamt: " . calcMeanStars($ratings) . ")";
    else
        echo "Ratings (Altogether: " . calcMeanStars($ratings) . ")";
    ?>
</h1>


<form method="get">
    <label for="search_text">Filter:</label>

    <input id="search_text" type="text" name="search_text" placeholder="<?php
    if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
        echo $_GET[GET_PARAM_SEARCH_TEXT];
    } else {
        echo "search";
    }
    ?>">

    <input type="submit" value="<?php
    if ($states[$display] == 'en')
        echo "Suche";
    else
        echo "Search";
    ?>">
</form>
<table class="rating">
    <thead>
    <tr>
        <td>Text</td>
        <td>Sterne</td>
        <td style="padding-left: 1em"> Autor</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($showRatings as $rating) {
        echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author' style='padding-left: 1em'>{$rating['author']}</td>
                  </tr>";
    }
    ?>
    </tbody>

</table>

<?php
echo '<ul>';
if ($states[$display] == 'en') {
    foreach ($allergens as $allerg) {
        echo '<li>' . $allerg . '</li>';
    }
} else {
    foreach ($translateallergens as $allerg) {
        echo '<li>' . $allerg . '</li>';
    }
}
echo '</ul>';
?>
</body>
</html>