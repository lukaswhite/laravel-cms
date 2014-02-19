<div class="block {{ $block->classes }}" id="block-{{ $block->machine_name }}">
	@if (strlen($block->title))
	<h4>{{ $block->title }}</h4>
	@endif
	<div class="content">
		{{ $block->content }}
	</div>
	<div class="actions">
		<ul>
			<li><a href="/cms/block/edit/{{ $block->id }}?return_url={{ $_SERVER['REQUEST_URI'] }}">Edit</a>
		</ul>
	</div>
</div>