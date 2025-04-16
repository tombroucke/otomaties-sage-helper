@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @switch ($locationType)
    @case('iframe')
      <div
        class="wp-block-location__iframe"
        data-zoom="16"
      >
        {!! $iframe !!}
      </div>
    @break

    @default
      @if ($location->isSet())
        <div
          class="wp-block-location__map"
          data-zoom="16"
        >
          <div
            class="wp-block-location__map__marker"
            data-lat="{{ $location->lat() }}"
            data-lng="{{ $location->lng() }}"
          >
            {!! wp_kses($info, $allowedTinyMceTags()) !!}
          </div>
        </div>
      @endif
  @endswitch

  @unless ($block->preview)
  </div>
@endunless
