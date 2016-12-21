@extends('app')

@section('content')
    <h1>Home</h1>
    <ul>
        @foreach ($pages as $page)
            <li>
                <a href="{{ $page->url }}">
                    {{ $page->title }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
