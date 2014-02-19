@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>Import</h1>

{{ Form::open() }}

	<div class="form-group">        
		{{ Form::label('path', 'Directory') }}
		{{ Form::text('path', false) }}
	</div>
  
  <div class="form-group">        
		{{ Form::submit('Import', array('class' => 'btn btn-lg btn-primary')) }}
	</div>

{{ Form::close() }}

@endsection
