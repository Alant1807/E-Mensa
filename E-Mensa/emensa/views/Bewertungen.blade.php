@extends('Layout.layoutBewertungen')

@section('bartitle')
    Bewertungen
@endsection

@section('title')
    Die aktuellsten Bewertungen
@endsection

@section('content')
    <form method="post" action="bewertungen">
        <table>
            <thead>
            <tr>
                <th>Gericht</th>
                <th>Sternenbewertung</th>
                <th>Bemerkung</th>
                <th>Bewertungszeitraum</th>
                <th>Kunde</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bewertungen as $bewertung)
                <tr>
                    <td>{{$bewertung['name']}}</td>
                    <td>{{$bewertung['sternebewertung']}}</td>
                    <td>{{$bewertung['bemerkung']}}</td>
                    <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                    <td>{{$bewertung['kunde']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <input type="submit" name="back" value="Hauptseite">
    </form>
@endsection
