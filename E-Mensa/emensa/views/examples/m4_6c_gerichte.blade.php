@extends('Layout.layout')

@section('content')
    @empty($eintrag)
        Es sind keine Gerichte vorhanden
    @endempty
    <ul>
        @foreach($eintrag as $NameUndPreis)
            <li>
                {{$NameUndPreis['name']}},
                {{$NameUndPreis['preis_intern']}} €
            </li>
        @endforeach
    </ul>
@endsection
