@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>{{ trans('laravel-cms::cms.blocks.add') }}</h1>

@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	</div>
@endif

{{ Form::open() }}

	<div class="form-group">        
		{{ Form::label('admin_title', trans('laravel-cms::cms.blocks.admin_title')) }}
		{{ Form::text('admin_title', null, array('class' => 'form-control', 'id' => 'block-admin-title')) }}
		<span class="help">{{ trans('laravel-cms::cms.blocks.admin_title_help') }}</span>
	</div>

	<div class="form-group">        
		{{ Form::label('machine_name', trans('laravel-cms::cms.blocks.machine_name')) }}
		{{ Form::text('machine_name', null, array('class' => 'form-control machine-name', 'id' => 'machine-name')) }}
	</div>

	<div class="form-group">        
		{{ Form::label('title', trans('laravel-cms::cms.blocks.title')) }}
		{{ Form::text('title', null, array('class' => 'form-control', 'id' => 'block-title')) }}
		<span class="help">{{ trans('laravel-cms::cms.blocks.title_help') }}</span>
	</div>	

	<div class="form-group">        
		{{ Form::label('body', trans('laravel-cms::cms.blocks.body')) }}
		{{ Form::textarea('body', '', array('class' => 'form-control', 'id' => 'block-body', 'cols' => 50, 'rows' => 5)) }}
		<div id="block-body-editor" class="form-control editor"></div>
	</div>

	<div class="form-group">    
    <div class="radio">
      <label>
        {{ Form::radio('status', Lukaswhite\LaravelCms\Model\Block::PUBLISHED, true) }}
        {{ trans('laravel-cms::cms.published') }}
      </label>
     </div>
     <div class="radio">
      <label>
        {{ Form::radio('status', Lukaswhite\LaravelCms\Model\Block::UNPUBLISHED, false) }}
        {{ trans('laravel-cms::cms.unpublished') }}
      </label>
    </div>    
  </div>

  <div class="form-group">        
		{{ Form::label('classes', trans('laravel-cms::cms.blocks.classes')) }}
		{{ Form::text('classes', null, array('class' => 'form-control', 'id' => 'block-classes')) }}
		<span class="help">{{ trans('laravel-cms::cms.blocks.classes_help') }}</span>
	</div>
  
  <div class="form-group">        
		{{ Form::submit(trans('laravel-cms::cms.blocks.add'), array('class' => 'btn btn-lg btn-primary')) }}
	</div>

{{ Form::close() }}

@endsection

@section('jquery')

Cms.initAddBlock();

@endsection
