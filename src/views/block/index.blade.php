@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>{{ trans('laravel-cms::cms.menu.blocks') }}</h1>

<div class="well">
	<a href="/cms/block/add" class="btn btn-primary btn-lg">{{ trans('laravel-cms::cms.menu.block-add') }}</a>
	<a href="/cms/block/place" class="btn btn-primary btn-lg">{{ trans('laravel-cms::cms.menu.block-place') }}</a>
</div>

<table class="table table-striped table-bordered">
  <thead>
		<tr>
			<td>{{ trans('laravel-cms::cms.blocks.title') }}</td>
			<td>{{ trans('laravel-cms::cms.blocks.machine_name') }}</td>			
			<td>{{ trans('laravel-cms::cms.status') }}</td>
			<td>{{ trans('laravel-cms::cms.actions') }}</hd>
		</tr>		
  </thead>
  <tbody>
	@foreach ($blocks as $block)
		<tr>
			<td>{{ $block->admin_title }}</td>
			<td>{{ $block->machine_name }}</td>			
			<td>
			@if ($block->status == 1)
			<span class="label label-success">{{ trans('laravel-cms::cms.published') }}</span>
			@else
			<span class="label label-default">{{ trans('laravel-cms::cms.unpublished') }}</span>
			@endif
			</td>
			<td>
				<a href="/cms/block/preview/{{ $block->id }}" class="btn btn-primary">{{ trans('laravel-cms::cms.preview') }}</a> <a href="/cms/block/edit/{{ $block->id }}" class="btn btn-info">{{ trans('laravel-cms::cms.edit') }}</a> <a href="/cms/block/delete/{{ $block->id }}" class="btn btn-danger">{{ trans('laravel-cms::cms.delete') }}</a> 
			</td>
		</tr>
	@endforeach
  </tbody>
</table>

{{ $blocks->links() }}

@endsection

@section('jquery')

Cms.initListBlocks();

@endsection
