<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

@extends('Layout.layoutRegistrieren')

@section('bartitle')
    Registrieren
@endsection

@section('title')
    Registrieren
@endsection

@section('form')
    <form action="registrieren_verifizieren" method="POST">
        <p><input type="email" placeholder="E-Mail" name="email"></p>
        <div class="errormessage">
            @if(isset($existUser))
                {{$existUser}}
            @elseif(isset($emptyuser))
                {{$emptyuser}}
            @endif
        </div>
        <p><input type="password" placeholder="Passwort" name="password"></p>
        <div class="errormessage">
            @if(isset($emptypassword))
                {{$emptypassword}}
            @endif()
        </div>
        <p>
            <label>
                <input type="checkbox" name="checkadmin" id="checkadmin"> Admin
            </label>
        </p>
        <p class="submit"><input type="submit" name="submit" id="register" value="Registrieren"></p>
    </form>
@endsection
