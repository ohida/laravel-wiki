@extends('app')

@section('content')
    <h1>{{ $page->title }}</h1>
    @if ($page->id)
        <div>
            {!! $page->markdown_body !!}
        </div>
    @else
        <div class="well">
            この名前のページはまだ作成されていません
        </div>
        <div>
            <a href="{{ route('pages.create', ['title' => $page->title]) }}">ページを作成</a>
        </div>
    @endif
@endsection
