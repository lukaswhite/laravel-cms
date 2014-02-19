@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>Delete Page</h1>

{{ Form::open() }}

{{ Form::hidden('id') }}

	<h4>Are you sure you wish to delete this page?</h4?

  <div class="form-group">        
		<a href="/cms/page" class="btn btn-default">Cancel</a>
		{{ Form::submit('Delete', array('class' => 'btn btn-lg btn-primary')) }}
	</div>

{{ Form::close() }}

@endsection

@section('jquery')

Cms.initAddEdit();

@endsection
