@extends('Layout.layoutUpdateUser')

@section('bartitle')
    Konto entsperren
@endsection

@section('title')
    Konto entsperren
@endsection

@section('form')
    <form action="reset" method="POST">
        <label for="email">E-Mail:</label>
        <input type="email" name="email" id="email">
        <div class="errormessage">
        @if(isset($fail_email))
            {{$fail_email}}
        @elseif(isset($notequalMail))
            {{$notequalMail}}
        @endif
        </div>
        <label for="pass">Passwort:</label>
        <input type="password" id="pass" name="password">
        <div class="errormessage">
        @if(isset($failurepass))
            {{$failurepass}}
        @endif
        </div>
        <label for="repeatpass">Passwort wiederholen:</label>
        <input type="password" id="repeatpass" name="repeatpass">
        <div class="errormessage">
            @if(isset($failurerepeatpass))
                {{$failurerepeatpass}}
            @elseif(isset($notequalPass))
                {{$notequalPass}}
            @endif
        </div>
        <input type="submit" name="submit" value="Konto zurücksetzen">
    </form>
@endsection