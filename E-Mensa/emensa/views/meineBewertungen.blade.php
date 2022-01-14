@extends('Layout.layoutmeineBewertungen')

@section('bartitle')
    Meine Bewertungen
@endsection

@section('title')
    <div class="title">
        <h3> Meine Bewertungen </h3>
    </div>
@endsection

@section('content')
    <form method="post" action="meinebewertungen" class="container">
        <table>
            <thead>
            <tr>
                <th>Gericht</th>
                <th>Sternebewertung</th>
                <th>Bemerkung</th>
                <th>Bewertungszeitraum</th>
                <th>Markieren</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bewertungen as $bewertung)
                <tr>
                    <td>{{$bewertung['name']}}</td>
                    <td>{{$bewertung['sternebewertung']}}</td>
                    <td>{{$bewertung['bemerkung']}}</td>
                    <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                    <td><input type="checkbox" name="delete[]" value="{{$bewertung['id']}}"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <input type="submit" name="back" value="Hauptseite" class="buttonMain">
        <input type="submit" name="submitdelete" value="löschen" class="buttonSubmit">
    </form>
@endsection