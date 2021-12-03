<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        h3 {
            alignment: center
        }

        body {
            background-color: #333333;
            color: white
        }

        .Grid-Container1 {
            display: grid;
            grid-area: GerichtName;
            grid-template-areas: "LabelMealName FormGerichtName";
            grid-template-columns: 1fr 7fr
        }

        .Grid-Container2 {
            display: grid;
            grid-area: Beschreibung;
            grid-template-areas: "LabelDescription FormBeschreibung";
            grid-template-columns: 1fr 7fr
        }

        .Grid-Container3 {
            display: grid;
            grid-area: Kontaktdaten;
            grid-template-areas: "LabelName FormName LabelMail FormEmail";
            grid-template-columns: 1fr 3fr 1fr 3fr
        }


        .LabelDescription {
            grid-area: LabelDescription;
            display: grid
        }

        .LabelMail {
            grid-area: LabelMail
        }

        .LabelMealName {
            grid-area: LabelMealName
        }

        .LabelName {
            grid-area: LabelName
        }

        .form-beschreibung {
            grid-area: FormBeschreibung
        }

        .form-email {
            grid-area: FormEmail
        }

        .form-gerichtname {
            grid-area: FormGerichtName
        }

        .form-name {
            grid-area: FormName
        }

        .button {
            background-color: dodgerblue;
            color: white
        }


    </style>
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