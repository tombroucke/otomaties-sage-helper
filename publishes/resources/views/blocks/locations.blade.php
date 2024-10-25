@if ($locations->isNotEmpty())
  <x-block :block="$block">
    <div
      class="wp-block-locations__map"
      data-zoom="16"
    >
      @foreach ($locations as $location)
        <div
          class="wp-block-locations__map__marker"
          data-lat="{{ $location['location']->lat() }}"
          data-lng="{{ $location['location']->lng() }}"
        >
          {!! $location['info'] !!}
        </div>
      @endforeach
    </div>
  </x-block>
@endif
