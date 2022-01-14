<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

@extends('Layout.layoutwerbeseite')

@section('navbereich')
    <ul class="navbar">
        <li><img src="https://logosmarken.com/wp-content/uploads/2020/11/Red-Bull-Logo.png" class="logo"></li>
        <li><a class="active" href="#home">Home</a></li>
        <li><a href="#News">Nachrichten</a></li>
        <li><a href="#meals">Speisen</a></li>
        <li><a href="#numbers">Zahlen</a></li>
        <li><a href="#Contact">Kontakt</a></li>
        <li><a href="#About us">Wichtig für uns</a></li>
        <li>
            @if(isset($_SESSION['login_ok']))
                <a href="/abmeldung">Abmelden</a>
            @else
                <a href="/anmeldung">Anmelden</a>
        </li>
        <li>
            <a href="/registrieren">Registrieren</a>
            @endif
        </li>
    </ul>
    <br>
@endsection

@section('begrüßungstext')
    <!-- Text -->
    <div id="News" class="griditem TextArea">
        <h1>Bald gibt es Essen auch online ;)</h1>
        Mensen verpflegen – häufig in Verbindung mit Cafeterien – in erster Linie die Studenten und die Mitarbeiter
        von Hochschulen mit warmem Mittagessen, zum Teil auch Abendessen.
        Hochschulmensen gehören mit je bis zu 12.000 ausgegebenen Essen am Tag zu den größten Einrichtungen der
        Gemeinschaftsverpflegung.[1]
        In einigen Ländern werden Mensen von staatlicher Seite subventioniert, um die Teilnahme am Hochschulstudium
        finanziell zu fördern.
        Gegen einen Zuschlag als Subventionsausgleich stehen fast alle Mensen auch Gästen offen, die von außerhalb
        der Hochschule kommen.
        In Deutschland werden die meisten Mensen von den öffentlich-rechtlichen Studentenwerken betrieben, bei denen
        die soziale Unterstützung der Studenten gebündelt ist.
        Es gibt 58 selbständige Studentenwerke, die rund 700 gastronomische Einrichtungen betreiben; entsprechend
        unterschiedlich sind diese.
        [2] In Österreich werden die meisten Mensen von einer nationalen Betriebsgesellschaft unterhalten.
        In vielen anderen Ländern werden die Mensen von den Hochschulen selbst oder von gewinnorientierten Caterern
        betrieben.
    </div>
@endsection

@section('gerichtetabelle')
    <div id="meals" class="griditem MealTabel">
        <h1>Köstlichkeiten, die Sie erwarten</h1>
        <table>
            <thead>
            <tr>
                <th></th>
                <th> Preis intern</th>
                <th> Preis extern</th>
                <th> Allergene</th>
                <th> Bilder</th>
                @if(isset($_SESSION['login_ok']))
                    <th>Bewerten</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($gerichte as $key => $gericht)
                <tr>
                    <td>{{$gericht['name']}}</td>
                    <td>{{$gericht['preis_intern']}}€</td>
                    <td>{{$gericht['preis_extern']}}€</td>
                    <td>@if(isset($gericht['allergene'])){{$gericht['allergene']}} @endif</td>
                    @if($gericht['bildname'] == NULL || !file_exists("img/gerichte/" . $gericht['bildname']))
                        <td><img class="bilder" src="/img/gerichte/00_image_missing.jpg" alt="Bild des Gerichtes">
                        </td>
                    @else
                        <td><img class="bilder" src="/img/gerichte/{{$gericht['bildname']}}"
                                 alt="Bild des Gerichtes"
                            ></td>
                    @endif
                    @if(isset($_SESSION['login_ok']))
                        <td>
                            <a href="/bewertung?gerichtid={{$gericht['id']}}">Gericht bewerten</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <h4>Liste der Allergene</h4>
        @foreach($allergene as $allergen)
            {{$allergen['code']}} = {{$allergen['name']}} <br>
        @endforeach
    </div>
@endsection

@section('hervorgehobeneGerichte')
    <div class="griditem MarkMeal">
        <h1>Meinung unserer Kunedn</h1>
        <table>
            <thead>
            <th>Gericht</th>
            <th>Sternenbewertung</th>
            <th>Bemerkung</th>
            <th>Bewertungszeitraum</th>
            </thead>
            <tbody>
            @foreach($bewertungen as $bewertung)
                @if($bewertung['hervorgehoben'])
                    <tr>
                        <td>{{$bewertung['name']}}</td>
                        <td>{{$bewertung['sternebewertung']}}</td>
                        <td>{{$bewertung['bemerkung']}}</td>
                        <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('EmensaInZahlen')
    <div class="griditem EmensaInNumber grid-container-1">
        <h1 id="numbers" class="griditem1-1"> E-Mensa in Zahlen</h1>
        <div class="griditem-1 griditem1-2">
            {{$refresher}} Besuche
        </div>
        <div class="griditem-1 griditem1-3"><a class="br">
                @if(isset($newsletteranmeldung))
                    {{$newsletteranmeldungen}} Newsletter
                @else
                    0 Newsletter
                @endif
            </a></div>
        <div class="griditem-1 griditem1-4"> {{$getrows}} Speisen</div>
    </div>
@endsection

@section('Newsletter')
    <form class="griditem griditem5 grid-container-2" method="post" action="checkFormular">
        <h1 class="griditem2-1"> Interesse geweckt? Wir informieren Sie!</h1>
        <div class="griditem-2 griditem2-2">
            <a class="br">Ihr Name:</a>
            <input type="text" name="text" placeholder="Vorname">
        </div>

        <div class="griditem-2 griditem2-3">
            <a class="br">Ihre E-Mail:</a>
            <input type="text" name="email" placeholder="Max@Musterman.gmx.de">
        </div>
        <div class="griditem-2 griditem2-4">
            <a class="br">Newsletter bitte in:</a>
            <select name="language">
                <option value="deutsch"> Deutsch</option>
                <option value="englisch">Englisch</option>
                <option value="niederländisch">Niederländisch</option>
                <option value="Spanisch">Spanisch</option>
            </select>
        </div>
        <div class="griditem-2 griditem2-5">
            <p class="error">
                @if(isset($benutzername_error))
                    {{$benutzername_error}}
                @endif
            </p>
            <p class="error">
                @if(isset($email_error))
                    {{$email_error}}
                @elseif(isset($existemail))
                    {{$existemail}}
                @endif
            </p>
            <input type="checkbox" name="checkbox">
            Den Datenschutzbestimmungen Stimme ich zu
            <input type="submit" name="submit" value="Zum Newsletter anmelden" class="br post">
            <p class="error">
                @if(isset($checkbox_error))
                    {{$checkbox_error}}
                @endif
            </p>
            <p>
                @if(isset($noerror))
                    {{$noerror}}
                @endif
            </p>
        </div>
    </form>
@endsection

@section('impressum')
    <ol class="Impressum">
        <li><a>(c) E-Mensa GmbH &nbsp&nbsp|&nbsp&nbsp</a></li>
        <li>
            <a href="/profil">
                @if(isset($_SESSION['login_ok']))
                    {{$_SESSION['email']}} &nbsp&nbsp|&nbsp&nbsp
                @endif
            </a>
        </li>
        <li><a href=index.blade.php> Impressum &nbsp&nbsp|&nbsp&nbsp</a></li>
        <li><a href="/wunschgericht"> Wunschgericht</a></li>
        <li><a href="/bewertungen"> @if(isset($_SESSION['login_ok']))
                    &nbsp&nbsp|&nbsp&nbsp Bewertungen &nbsp&nbsp|&nbsp&nbsp
                @endif</a></li>
        <li><a href="/meinebewertungen"> @if(isset($_SESSION['login_ok']))
                    meine Bewertungen
                @endif</a></li>
    </ol>
@endsection