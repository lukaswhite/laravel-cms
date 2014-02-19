@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>{{ trans('laravel-cms::cms.menu.regions') }}</h1>

<div class="well">
	<a href="/cms/region/add" class="btn btn-primary btn-lg">{{ trans('laravel-cms::cms.menu.region-add') }}</a>
</div>

<table class="table table-striped table-bordered">
  <thead>
		<tr>
			<td>{{ trans('laravel-cms::cms.regions.title') }}</td>
			<td>{{ trans('laravel-cms::cms.regions.machine_name') }}</td>						
			<td>{{ trans('laravel-cms::cms.actions') }}</hd>
		</tr>		
  </thead>
  <tbody>
	@foreach ($regions as $region)
		<tr>
			<td>{{ $region->title }}</td>
			<td>{{ $region->machine_name }}</td>						
			<td>
				<a href="/cms/region/preview/{{ $region->id }}" class="btn btn-primary">{{ trans('laravel-cms::cms.preview') }}</a> <a href="/cms/region/edit/{{ $region->id }}" class="btn btn-info">{{ trans('laravel-cms::cms.edit') }}</a> <a href="/cms/region/delete/{{ $region->id }}" class="btn btn-danger">{{ trans('laravel-cms::cms.delete') }}</a> 
			</td>
		</tr>
	@endforeach
  </tbody>
</table>

@endsection

@section('jquery')

Cms.initListBlocks();

@endsection
