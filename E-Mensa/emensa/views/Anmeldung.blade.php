<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

@extends('Layout.layoutAnmeldung')

@section('bartitle')
    Anmeldung
@endsection

@section('title')
    Anmelden
@endsection

@section('form')
    <form action="anmeldung_verifizieren" method="POST">
        <p><input type="email" placeholder="E-Mail" name="email"></p>
        <div class="errormessage">
            @if(isset($emptyuser) && ($_SESSION["login_attempts"] ?? 0) < 3)
                {{$emptyuser}}
            @endif
        </div>
        <p><input type="password" placeholder="Passwort" name="password"></p>
        <div class="errormessage">
            @if(isset($emptypassword) && ($_SESSION["login_attempts"] ?? 0) < 3)
                {{$emptypassword}}
            @endif
        </div>
        <p>
            <label>
                <input type="checkbox" name="checkadmin" id="checkadmin"> Admin
            </label>
        </p>
        <p class="submit">
            @if(($_SESSION["login_attempts"] ?? 0) > 2)
                Ihr Konto ist gesperrt <input type="submit" name="reset" value="Zurücksetzen">
            @else
                <input type="submit" name="submit" id="login" value="Anmeldung">
            @endif
        </p>
        @if(isset($msg) && !isset($emptyuser) && !isset($emptypassword) && ($_SESSION["login_attempts"] ?? 0) < 3)
            <div class="errormessage">{{$msg}}</div>
        @endif
        @if(isset($login_fail_admin) && ($_SESSION["login_attempts"] ?? 0) < 3)
            <div class="errormessage">{{$login_fail_admin}}</div>
        @endif
    </form>
@endsection
