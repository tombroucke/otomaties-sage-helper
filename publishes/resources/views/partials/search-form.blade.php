<form role="search" method="get" class="search-form" action="{{ home_url( '/' ) }}">
  <label for="search-form__input">
    <span>{!! _x( 'Search for:', 'label' ) !!}</span>
  </label>
  <x-input-group>
    <input type="search" id="search-form__input" class="form-control" placeholder="{{ esc_attr_x( 'Search …', 'placeholder' ) }}" value="{{ get_search_query() }}" name="s" title="{{ esc_attr_x( 'Search for:', 'label' ) }}" />
    <x-button type="submit">{!! esc_attr_x( 'Search', 'submit button' ) !!}</x-button>
  </x-input-group>
</form>
