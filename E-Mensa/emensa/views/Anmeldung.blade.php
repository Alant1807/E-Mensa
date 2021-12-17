@extends('Layout.layoutAnmeldung')

@section('bartitle')
    Anmeldung
@endsection

@section('title')
    Anmelden
@endsection

@section('form')
    <form action="anmeldung_verifizieren" method="POST">
        <label for="user">E-Mail:</label>
        <input type="email" id="user" name="email">
        <div class="errormessage">
        @if(isset($emptyuser))
            {{$emptyuser}}
        @endif
        </div>
        <label for="pass">Passwort:</label>
        <input type="password" id="pass" name="password" >
        <div class="errormessage">
        @if(isset($emptypassword))
            {{$emptypassword}}
        @endif
        </div>
        <input type="checkbox" name="checkadmin"> Admin
        <input type="submit" name="submit" value="Anmeldung">
        <div class="errormessage">
        @if(isset($msg) && !isset($emptyuser) && !isset($emptypassword))
            {{$msg}}
        @endif
        </div>
    </form>
@endsection
