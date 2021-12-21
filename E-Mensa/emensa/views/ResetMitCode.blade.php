@extends('Layout.layoutResetMitCode')

@section('bartitle')
    Konto entsperren
@endsection

@section('title')
    Konto entsperren
@endsection

@section('form')
    <form method="post" action="checkCode">
        <label for="code">
            Geben Sie Ihren persönlichen Code, zur Wiederherstellung Ihres Kontos
        </label>
        <input type="text" id="code" name="code">
        <div class="errormessage">
            @if(isset($emptycode))
                {{$emptycode}}
            @elseif(isset($falsecode))
                {{$falsecode}}
            @endif
        </div>
        <input type="submit" name="submitcode" value="Zurücksetzen">
    </form>
@endsection