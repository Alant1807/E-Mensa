<!--
- Praktikum DBWT. Autoren:
- Paul, Ebeling, 3272182
- Alan, Tofeq, 3286019
-->

@extends('Layout.layoutUpdateUser')

@section('bartitle')
    Konto entsperren
@endsection

@section('title')
    Konto entsperren
@endsection

@section('form')
    <form action="reset" method="POST">
        <p><input type="email" placeholder="E-Mail" name="email"></p>
        <div class="errormessage">
            @if(isset($fail_email))
                {{$fail_email}}
            @elseif(isset($notequalMail))
                {{$notequalMail}}
            @endif
        </div>
        <p><input type="password" placeholder="Passwort" name="password"></p>
        <div class="errormessage">
            @if(isset($failurepass))
                {{$failurepass}}
            @endif
        </div>
        <p><input type="password" placeholder="Passwort wiederholen" id="repeatpass" name="repeatpass"></p>
        <div class="errormessage">
            @if(isset($failurerepeatpass))
                {{$failurerepeatpass}}
            @elseif(isset($notequalPass))
                {{$notequalPass}}
            @endif
        </div>
        <p class="submit"><input type="submit" name="submit" value="Konto zurücksetzen"></p>
    </form>
@endsection