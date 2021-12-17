@extends('Layout.layoutAnmeldung')

@section('bartitle')
    Anmeldung
@endsection

@section('title')
    Anmelden
@endsection

@section('form')
    <form action="anmeldung_verifizieren" method="POST">
        <label for="user">E-Mail:</label><br>
        <input type="email" id="user" name="email"><br>
        @if(isset($emptyuser))
            {{$emptyuser}}
        @endif
        <label for="pass">Passwort:</label><br>
        <input type="password" id="pass" name="password" ><br>
        @if(isset($emptypassword))
            {{$emptypassword}}
        @endif
        <input type="checkbox" name="checkadmin"> Admin<br>
        <input type="submit" name="submit" value="Anmeldung">
        <input type="submit" name="back" value="Hauptseite"><br><br>
        @if(isset($msg) && !isset($emptyuser) && !isset($emptypassword))
            {{$msg}}
        @endif
    </form>
@endsection
