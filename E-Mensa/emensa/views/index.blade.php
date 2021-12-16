@extends('layoutwerbeseite')

@section('navbereich')
    <ul class="navbar">
        <li><img src="https://logosmarken.com/wp-content/uploads/2020/11/Red-Bull-Logo.png" class="logo"></li>
        <li><a class="active" href="#home">Home</a></li>
        <li><a href="#News">Nachrichten</a></li>
        <li><a href="#meals">Speisen</a></li>
        <li><a href="#numbers">Zahlen</a></li>
        <li><a href="#Contact">Kontakt</a></li>
        <li><a href="#About us">Wichtig für uns</a></li>
        <li><a href="/Anmeldung">Anmelden</a></li>
    </ul>
    <br>
@endsection

@section('begrüßungstext')
    <!-- Text -->
    <div id="News" class="griditem griditem1">
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
    <div id="meals" class="griditem griditem2">
        <h1>Köstlichkeiten, die Sie erwarten</h1>
        <table>
            <thead>
            <tr>
                <th></th>
                <th> Preis intern</th>
                <th> Preis extern</th>
                <th> Allergene</th>
            </tr>
            </thead>
            <tbody>
            @foreach($gerichte as $key => $gericht)
                <tr>
                    <td>{{$gericht['name']}}</td>
                    <td>{{$gericht['preis_intern']}}</td>
                    <td>{{$gericht['preis_extern']}}</td>
                    <td>{{$gericht['allergene']}}</td>
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

@section('impressum')
    <ol class="Impressum">
        <li><a>(c) E-Mensa GmbH &nbsp&nbsp|&nbsp&nbsp</a></li>
        <li><a>Name &nbsp&nbsp|&nbsp&nbsp</a></li>
        <li><a href=index.blade.php> Impressum &nbsp&nbsp|&nbsp&nbsp</a></li>
        <li><a href=""> Wunschgericht </a></li>
    </ol>
@endsection

