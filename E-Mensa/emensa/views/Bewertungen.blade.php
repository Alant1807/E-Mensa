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
                @if($userinfo['admin'] == 1)
                    <th>Hervorhebung</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @if($userinfo['admin'] == 0)
                @foreach($bewertungen as $bewertung)
                    <tr class="@if($bewertung['hervorgehoben'])
                            marked
                            @endif
                            ">
                        <td>{{$bewertung['name']}}</td>
                        <td>{{$bewertung['sternebewertung']}}</td>
                        <td>{{$bewertung['bemerkung']}}</td>
                        <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                        <td>{{$bewertung['kunde']}}</td>
                    </tr>
                @endforeach
            @else
                @foreach($bewertungen as $bewertung)
                    <tr class="@if($bewertung['hervorgehoben'])
                        marked
                    @endif
                    ">
                        <td>{{$bewertung['name']}}</td>
                        <td>{{$bewertung['sternebewertung']}}</td>
                        <td>{{$bewertung['bemerkung']}}</td>
                        <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                        <td>{{$bewertung['kunde']}}</td>
                        <td>
                                @if($bewertung['hervorgehoben'])
                                    <a  href="/bewertungen?bewertungsid={{$bewertung['id']}}" onclick="<meta http-equiv='refresh' content='0'>">
                                    Hervorhebung Auflösen
                                    </a>
                                @else
                                            <a  href="/bewertungen?bewertungsid={{$bewertung['id']}}" onclick="<meta http-equiv='refresh' content='0'>">
                                                Hervorheben
                                            </a>
                                @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <input type="submit" name="back" value="Hauptseite">
    </form>
@endsection
