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
        <input type="password" id="pass" name="password">
        <div class="errormessage">
            @if(isset($emptypassword))
                {{$emptypassword}}
            @endif
        </div>
        <input type="checkbox" name="checkadmin"> Admin
        <div>
            @if($_SESSION["login_attempts"] > 2)
                Ihr Konto ist gesperrt <input type="submit" name="reset" value="Zurücksetzen">
            @else
                <input type="submit" name="submit" value="Anmeldung">
            @endif
        </div>
        <div class="errormessage">
            @if(isset($msg) && !isset($emptyuser) && !isset($emptypassword) && $_SESSION["login_attempts"] < 3)
                {{$msg}}
            @elseif(isset($login_fail_admin))
                <div>{{$login_fail_admin}}</div>
            @endif
        </div>
    </form>
@endsection
