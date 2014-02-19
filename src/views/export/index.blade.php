@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>Export</h1>

{{ Form::open() }}

	<div class="form-group">        
		{{ Form::label('unpublished', 'Include unpublished?') }}
		{{ Form::checkbox('unpublished', false) }}
	</div>
  
  <div class="form-group">        
		{{ Form::submit('Export', array('class' => 'btn btn-lg btn-primary')) }}
	</div>

{{ Form::close() }}

@endsection
