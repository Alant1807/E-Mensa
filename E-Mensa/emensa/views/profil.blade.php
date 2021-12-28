@extends('Layout.layoutProfil')

@section('bartitle')
    Profil
@endsection

@section('title')
    Profil
@endsection

@section('content')
    <form action="profil" method="post">
        <p id="email">
            E-Mail: {{$userinfo['email']}}
        </p>
        <p id="countlogins">
            Anzahl an Anmeldungen: {{$userinfo['anzahlanmeldungen']}}
        </p>
        <p id="admin">
            @if($userinfo['admin'] == 1)
                Sie sind Admin
            @else
                Sie sind kein Admin
            @endif
        </p>
        <p class="submit">
            <input type="submit" name="zurueck" value="Hauptseite">
        </p>
    </form>
@endsection
