@extends('Layout.layoutBewertung')

@section('bartitle')
    Bewertung
@endsection

@section('title')
    Bewertung für {{$gericht['name']}}
@endsection

@section('Bild')
    @if($gericht['bildname'] == NULL || !file_exists("img/gerichte/" . $gericht['bildname']))
        <td ><img class="bilder" src="/img/gerichte/00_image_missing.jpg" alt="Bild des Gerichtes">
        </td>
    @else
        <td><img class="bilder" src="/img/gerichte/{{$gericht['bildname']}}"
                 alt="Bild des Gerichtes"
            ></td>
    @endif
@endsection

@section('form')
    <form method="post" action="bewertung">
        <p>Ihre Bewertung für das Gericht:</p>
        <fieldset>
            <div>
                <input type="radio" id="sehrgut" name="bewertung" value="sehr gut" checked>
                <label for="sehrgut">sehr gut</label>
            </div>
            <div>
                <input type="radio" id="gut" name="bewertung" value="gut">
                <label for="gut">gut</label>
            </div>
            <div>
                <input type="radio" id="schlecht" name="bewertung" value="schlecht">
                <label for="schlecht">schlecht</label>
            </div>
            <div>
                <input type="radio" id="sehrschlecht" name="bewertung" value="sehr schlecht">
                <label for="sehrschlecht">sehr schlecht</label>
            </div>
        </fieldset>
        <label for="review">Bemerkung</label>
        <textarea rows="5" cols="40" id="review" name="bemerkung" minlength="5"></textarea><br>
        <input type="hidden" id="gerichtid" name="gerichtID" value="{{$gericht['id']}}">
        <input type="submit" name="submit" value="Absenden">
        <input type="submit" name="back" value="Hauptseite">
    </form>
@endsection
