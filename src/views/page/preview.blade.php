@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>{{ $page->title }}</h1>

{{ $content }}

@endsection