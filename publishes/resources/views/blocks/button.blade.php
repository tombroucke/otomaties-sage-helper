<x-button :href="$button->url()" :target="$button->target()" :theme="$theme" class="d-inline-block">
	{!! esc_html($button->title()) !!}
</x-button>  
