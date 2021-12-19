@extends('Layout.layoutProfil')

@section('bartitle')
    Profil
@endsection

@section('title')
    Profil
@endsection

@section('content')
    <form action="profil" method="post">
        <div>
            E-Mail: {{$userinfo['email']}}
        </div>
        <div>
            Anzahl an Anmeldungen: {{$userinfo['anzahlanmeldungen']}}
        </div>
        <div>
            @if($userinfo['admin'] == 1)
                Admin
            @else
                kein Admin
            @endif
        </div>
        <div>
            <input type="submit" name="zurueck" value="Hauptseite">
        </div>
    </form>
@endsection
