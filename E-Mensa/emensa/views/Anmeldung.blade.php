@extends('Layout.layoutAnmeldung')

@section('bartitle')
    Anmeldung
@endsection

@section('title')
    Anmelden
@endsection

@section('form')
    {{$msg}}
    <form action="/anmeldung_verifizieren" method="POST">
        <label for="user">E-Mail:</label><br>
        <input type="email" id="user" name="email" required><br>
        <label for="pass">Passwort:</label><br>
        <input type="password" id="pass" name="password" required><br>
        <input type="checkbox" name="checkadmin"> Admin><br>
        <input type="submit" name="submit" value="Anmeldung"><br><br>
    </form>
@endsection
