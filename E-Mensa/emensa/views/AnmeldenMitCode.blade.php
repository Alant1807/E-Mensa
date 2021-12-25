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
        <p><input type="text" id="code" name="code"></p>
        <div class="errormessage">
            @if(isset($emptycode))
                {{$emptycode}}
            @endif
        </div>
        <p class="submit"><input type="submit" name="submitcode" value="Registrieren"></p>
    </form>
@endsection