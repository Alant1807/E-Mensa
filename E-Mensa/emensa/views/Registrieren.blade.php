@extends('Layout.layoutRegistrieren')

@section('bartitle')
    Registrieren
@endsection

@section('title')
    Registrieren
@endsection

@section('form')
    <form action="registrieren_verifizieren" method="POST">
        <label for="user">E-Mail:</label>
        <input type="email" id="user" name="email">
        <div class="errormessage">
            @if(isset($existUser))
                {{$existUser}}
            @elseif(isset($emptyuser))
                {{$emptyuser}}
            @endif
        </div>
        <label for="pass">Passwort:</label>
        <input type="password" id="pass" name="password">
        <div class="errormessage">
        @if(isset($emptypassword))
            {{$emptypassword}}
        @endif()
        </div>
        <input type="checkbox" name="checkadmin"> Admin
        <input type="submit" name="submit" value="Registrieren">
    </form>
@endsection
