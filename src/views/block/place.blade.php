@extends(Config::get('laravel-cms::layouts.admin'))

@section('content')

<h1>{{ trans('laravel-cms::cms.menu.blocks') }}</h1>

<div id="place-blocks">

	<div class="row">

		<div class="col-sm-12 col-md-6 col-lg-6" id="place-blocks-regions">

			@foreach ($regions as $region)

			<div class="region" id="region-{{ $region->machine_name }}">
				<h4>{{ $region->title }}</h4>
				<div class="blocks" id="region-{{ $region->machine_name }}-blocks">

					

				</div>
			</div>

			@endforeach

		</div>

		<div class="col-sm-12 col-md-6 col-lg-6" id="place-blocks-blocks">

			@foreach ($blocks as $block)

			<div class="block" id="block-{{ $block->machine_name }}">
				<h4>{{ $block->admin_title }}</h4>
			</div>

			@endforeach

		</div>

	</div>

</div>

@endsection

@section('jquery')

Cms.initPlaceBlocks();

@endsection
