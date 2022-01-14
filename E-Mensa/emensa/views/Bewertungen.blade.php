@extends('Layout.layoutBewertungen')

@section('bartitle')
    Bewertungen
@endsection

@section('title')
    <div class="title">
        <h3> Die aktuellsten Bewertungen </h3>
    </div>
@endsection

@section('content')
    <form method="post" action="bewertungen" class="container">
        <table>
            <thead>
            <tr>
                <th>Gericht</th>
                <th>Sternenbewertung</th>
                <th>Bemerkung</th>
                <th>Bewertungszeitraum</th>
                <th>Kunde</th>
                @if($_SESSION['admin'] == true) <th>Hervorhebung</th> @endif
            </tr>
            </thead>
            <tbody>
            @foreach($bewertungen as $bewertung)
                <tr class="@if($bewertung['hervorgehoben'] && $_SESSION['admin'] == true) marked @endif">
                    <td>{{$bewertung['name']}}</td>
                    <td>{{$bewertung['sternebewertung']}}</td>
                    <td>{{$bewertung['bemerkung']}}</td>
                    <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                    <td>{{$bewertung['kunde']}}</td>
                    <td>
                        @if($_SESSION['admin'] == 1 )
                            <a  href="/bewertungen?hervorheben={{$bewertung['id']}}" >
                                @if($bewertung['hervorgehoben'])
                                    Hervorhebung Auflösen
                                @else
                                    Hervorheben
                                @endif
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <input type="submit" name="back" value="Hauptseite" class="button">
    </form>
@endsection