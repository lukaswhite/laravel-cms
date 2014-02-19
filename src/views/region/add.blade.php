@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>{{ trans('laravel-cms::cms.regions.add') }}</h1>

@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	</div>
@endif

{{ Form::open() }}

	<div class="form-group">        
		{{ Form::label('title', trans('laravel-cms::cms.regions.title')) }}
		{{ Form::text('title', null, array('class' => 'form-control', 'id' => 'region-title')) }}		
	</div>	

	<div class="form-group">        
		{{ Form::label('machine_name', trans('laravel-cms::cms.regions.machine_name')) }}
		{{ Form::text('machine_name', null, array('class' => 'form-control machine-name', 'id' => 'machine-name')) }}
	</div>
  
  <div class="form-group">        
		{{ Form::submit(trans('laravel-cms::cms.regions.add'), array('class' => 'btn btn-lg btn-primary')) }}
	</div>

{{ Form::close() }}

@endsection

@section('jquery')

Cms.initAddRegion();

@endsection
