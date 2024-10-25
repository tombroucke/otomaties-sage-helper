@if ($location->isSet())
  <x-block :block="$block">
    <div
      class="wp-block-location__map"
      data-zoom="16"
    >
      <div
        class="wp-block-location__map__marker"
        data-lat="{{ $location->lat() }}"
        data-lng="{{ $location->lng() }}"
      >
        {!! $info !!}
      </div>
    </div>
  </x-block>
@endif
