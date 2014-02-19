@extends('laravel-cms::layouts.default')

@section('content')

<h1>Edit Page</h1>

@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	</div>
@endif

{{ Form::model($page) }}

{{ Form::hidden('id') }}

	<div class="form-group">        
		{{ Form::label('title', 'Page Title:') }}
		{{ Form::text('title', null, array('class' => 'form-control', 'id' => 'page-title')) }}
	</div>

	<div class="form-group">        
		{{ Form::label('slug', 'Slug:') }}
		{{ Form::text('slug', null, array('class' => 'form-control page-slug', 'id' => 'page-slug')) }}
	</div>

	<div class="form-group">        
		{{ Form::label('body', 'Body:') }}
		{{ Form::textarea('body', null, array('class' => 'form-control', 'id' => 'page-body', 'cols' => 50, 'rows' => 10)) }}
		<div id="page-body-editor" class="form-control editor"></div>
	</div>

	<div class="form-group">    
    <div class="radio">
      <label>
        {{ Form::radio('status', Lukaswhite\LaravelCms\Model\Page::PUBLISHED) }}
        Published
      </label>
     </div>
     <div class="radio">
      <label>
        {{ Form::radio('status', Lukaswhite\LaravelCms\Model\Page::UNPUBLISHED) }}
        Unpublished
      </label>
    </div>    
  </div>
  
  <div class="form-group">        
		{{ Form::submit('Add Page', array('class' => 'btn btn-lg btn-primary')) }}
	</div>

{{ Form::close() }}

@endsection

@section('jquery')

Cms.initAddEditPage();

@endsection
