<x-block :block="$block">
	@if ($subpages)
	  <x-list-group>
		@foreach ($subpages as $subpage)
		  <x-list-group.link href="{{ get_permalink($subpage->ID) }}">
			{!! $subpage->post_title !!}
		  </x-list-group.link>
		@endforeach
	  </x-list-group>
	@endif
</x-block>
  