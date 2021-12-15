<x-block :block="$block">
  @if($location)
    <div class="wp-block-location__map" data-zoom="16">
      <div class="wp-block-location__map__marker" data-lat="{{ $location->lat() }}" data-lng="{{ $location->lng() }}"></div>
    </div>
  @endif
</x-block>
