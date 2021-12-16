@extends('Layout.layoutAnmeldung')

@section('bartitle')
    Registrieren
@endsection

@section('title')
    Registrieren
@endsection

@section('form')
    {{$msg}}
    <form action="/registrieren_verifizieren" method="POST">
        <label for="user">E-Mail:</label><br>
        <input type="email" id="user" name="email" required><br>
        <label for="pass">Passwort:</label><br>
        <input type="password" id="pass" name="password" required><br>
        <input type="checkbox" name="checkadmin"> Admin><br>
        <input type="submit" name="submit" value="Registrieren"><br><br>
    </form>
@endsection
