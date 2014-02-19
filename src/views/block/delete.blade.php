@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>{{ trans('laravel-cms::cms.menu.block-delete') }}</h1>

{{ Form::open() }}

{{ Form::hidden('id') }}

	<h4>{{ trans('laravel-cms::cms.blocks.delete-confirm') }}</h4?

  <div class="form-group">        
		<a href="/cms/block" class="btn btn-default">{{ trans('laravel-cms::cms.cancel') }}</a>
		{{ Form::submit(trans('laravel-cms::cms.delete'), array('class' => 'btn btn-lg btn-primary')) }}
	</div>

{{ Form::close() }}

@endsection