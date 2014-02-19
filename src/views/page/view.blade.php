@extends(Config::get('laravel-cms::layouts.public'))

@section('content')

<h1>{{ $page->title }}</h1>

{{ $content }}

@endsection