@extends('Layout.layoutAnmeldung')

@section('bartitle')
    Registrieren
@endsection

@section('title')
    Registrieren
@endsection

@section('form')
    <form action="registrieren_verifizieren" method="POST">
        <label for="user">E-Mail:</label><br>
        <input type="email" id="user" name="email"><br>
        @if(isset($existUser))
            {{$existUser}}
        @elseif(isset($emptyuser))
            {{$emptyuser}}
        @endif
        <label for="pass">Passwort:</label><br>
        <input type="password" id="pass" name="password"><br>
        @if(isset($emptypassword))
            {{$emptypassword}}
        @endif()
        <input type="checkbox" name="checkadmin"> Admin<br>
        <input type="submit" name="submit" value="Registrieren">
        <input type="submit" name="back" value="Hauptseite"><br><br>
    </form>
@endsection
