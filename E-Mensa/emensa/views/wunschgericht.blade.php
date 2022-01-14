<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

@extends('Layout.layoutwunschgericht')

@section('bartitle')
    Wunschgericht
@endsection

@section('form')
    <form class="form" method="post" action="wunschgericht">
        <div class="title">
            <h3>Tragen Sie ihr Wunschgericht ein</h3>
        </div>
        <div class="name input">
            <label for="mealname" class="LabelMealName"></label>
            <input id="mealname" class="form-gerichtname" placeholder="Name des Gerichtes" type="text" name="mealname">
        </div>
        <div class="description input">
            <label for="description" class="LabelDescription"></label>
            <textarea id="description" class="form-beschreibung" placeholder="Beschreibung" type="text" name="description"></textarea>
        </div>
        <div class="vegan input">
            <label for="setVegan" class="LabelVegan"></label>
            <textarea rows="1" cols="4" id="setVegan" class="FormVegan" placeholder="Soll Ihr Gericht vegan sein? Schreiben Sie Ja oder Nein" name="vegan" maxlength="4"></textarea>
        </div>
        <div class="vegetarian input">
            <label for="setVegetarisch" class="LabelVegetarisch"></label>
            <textarea rows="1" cols="4" id="setVegetarisch" class="FormVegetarisch" placeholder="Soll Ihr Gericht vegan sein? Schreiben Sie Ja oder Nein" name="vegetarisch" maxlength="4"></textarea>
        </div>
        <div class="priceIntern input">
            <label for="setpreisIntern" class="LabelPreisIntern"></label>
            <input id="setpreisIntern" class="FormpreisIntern" placeholder="Wunschpreis intern?" type="text" name="preisIntern">
        </div>
        <div class="priceExtern input">
            <label for="setpreisExtern" class="LabelPreisExtern"></label>
            <input id="setpreisExtern" class="FormpreisExtern" placeholder="Wunschpreis Extern?" type="text" name="preisExtern">
        </div>
        <input type="submit" <?php echo 'value="' . htmlspecialchars('Abschicken') . '"'; ?> name="submit" class="button">
    </form>
@endsection