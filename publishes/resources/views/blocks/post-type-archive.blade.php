<x-block :block="$block">
	@while($postTypeQuery->have_posts()) @php($postTypeQuery->the_post())
	  @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
	@endwhile
	@include('partials.pagination', ['wpQuery' => $postTypeQuery])
</x-block>  
