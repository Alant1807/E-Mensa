<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Wunschgericht</title>

</head>

<body>
<h3>Tragen sie ihr Wunschgericht ein</h3>

<form class="form" method="post" action="wunschgerichtFormular.php">

    <a class="Grid-Container1">
        <label for="mealname" class="LabelMealName">Name des Gerichtes</label>
        <input id="mealname" class="form-gerichtname" type="text" name="mealname">
    </a>

    <a class="Grid-Container2"
    <label for="description" class="LabelDescription">Beschreibung</label>
    <input id="description" class="form-beschreibung" type="text" name="description">
    </a>

    <a class="Grid-Container3">
        <label for="mail" class="LabelMail">E-Mail</label>
        <input id="mail" class="form-email" type="email" name="mail">
        <label for="name" class="LabelName">Name</label>
        <input id="name" class="form-name" type="text" name="name">
    </a>

    <input type="submit" <?php echo 'value="' . htmlspecialchars('Abschicken') . '"'; ?> name="submit" class="button">
</form>
</body>