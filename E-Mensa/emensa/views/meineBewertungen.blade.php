@extends('Layout.layoutmeineBewertungen')

@section('bartitle')
    Meine Bewertungen
@endsection

@section('title')
    Meine Bewertungen
@endsection

@section('content')
    <form method="post" action="meinebewertungen">
        <table>
            <thead>
            <tr>
                <th>Gericht</th>
                <th>Sternenbewertung</th>
                <th>Bemerkung</th>
                <th>Bewertungszeitraum</th>
            </tr>
            </thead>
            <tbody>
                @foreach($bewertungen as $bewertung)
                    <tr>
                        <td>{{$bewertung['name']}}</td>
                        <td>{{$bewertung['sternebewertung']}}</td>
                        <td>{{$bewertung['bemerkung']}}</td>
                        <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                        <td><input type="checkbox" name="delete[]" value="{{$bewertung['gericht_id']}}"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <input type="submit" name="back" value="Hauptseite">
        <input type="submit" name="submitdelete" value="löschen">
    </form>
@endsection
