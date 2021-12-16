@extends('Layout.layout')

@section('css')
    <style>
        #odd:nth-child(even) {
            font-weight: bold;
        }
    </style>
@endsection

<ul>
    @section('content')
        @foreach($kategoriename as $name)
            <li id="odd">
                {{$name['name']}}
            </li>
        @endforeach
</ul>
@endsection
