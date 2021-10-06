<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
	<x-input-group>
		<label for="s" class="visually-hidden-focusable">
			{{ _x('Search for:', 'label', 'sage') }}
		</label>
		<input type="search" class="form-control" placeholder="{!! esc_attr_x('Search &hellip;', 'placeholder', 'sage') !!}" value="{{ get_search_query() }}" id="s" name="s">
		<input type="submit" class="btn btn-primary" value="{{ esc_attr_x('Search', 'submit button', 'sage') }}" >
	</x-input-group>
</form>  
