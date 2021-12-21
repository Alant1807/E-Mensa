@extends('Layout.layoutAnmeldungMitCode')

@section('bartitle')
    Anmeldung
@endsection

@section('title')
    Anmelden
@endsection

@section('form')
    <form method="post" action="code">
        <label for="code">
            Geben Sie Ihren persönlichen Code, den sie zur Wiederherstellung Ihres Kontos verwenden werden
        </label>
        <input type="text" id="code" name="code">
        <div class="errormessage">
            @if(isset($emptycode))
                {{$emptycode}}
            @endif
        </div>
        <input type="submit" name="submitcode" value="Registrieren">
    </form>
@endsection