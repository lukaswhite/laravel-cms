@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>{{ trans('laravel-cms::cms.menu.pages') }}</h1>

<div class="well">
	<a href="/cms/page/add" class="btn btn-primary btn-lg">{{ trans('laravel-cms::cms.menu.page-add') }}</a>
</div>

<table class="table table-striped table-bordered">
  <thead>
		<tr>
			<td>{{ trans('laravel-cms::cms.pages.title') }}</td>
			<td>{{ trans('laravel-cms::cms.created') }}</td>
			<td>{{ trans('laravel-cms::cms.status') }}</td>
			<td>{{ trans('laravel-cms::cms.actions') }}</hd>
		</tr>		
  </thead>
  <tbody>
	@foreach ($pages as $page)
		<tr>
			<td>{{ $page->title }}</td>
			<td>{{ $page->created_at }}</td>
			<td>
			@if ($page->status == 1)
			<span class="label label-success">{{ trans('laravel-cms::cms.published') }}</span>
			@else
			<span class="label label-default">{{ trans('laravel-cms::cms.unpublished') }}</span>
			@endif
			</td>
			<td>
				<a href="/cms/page/preview/{{ $page->id }}" class="btn btn-primary">{{ trans('laravel-cms::cms.preview') }}</a> <a href="/cms/page/edit/{{ $page->id }}" class="btn btn-info">{{ trans('laravel-cms::cms.edit') }}</a> <a href="/cms/page/delete/{{ $page->id }}" class="btn btn-danger">{{ trans('laravel-cms::cms.delete') }}</a> 
			</td>
		</tr>
	@endforeach
  </tbody>
</table>

{{ $pages->links() }}

@endsection

@section('jquery')

Cms.initAdd();

@endsection
