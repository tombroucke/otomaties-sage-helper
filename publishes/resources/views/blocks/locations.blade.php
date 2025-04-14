@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @if ($locations->isNotEmpty())
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
          {!! wp_kses($location['info'], $allowedTinyMceTags()) !!}
        </div>
      @endforeach

    </div>
  @endif

  @unless ($block->preview)
  </div>
@endunless

{!! $info !!}
