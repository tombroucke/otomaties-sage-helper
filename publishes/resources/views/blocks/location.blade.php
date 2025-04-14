@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

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

  @unless ($block->preview)
  </div>
@endunless
