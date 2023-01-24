<x-block :block="$block" class="d-block {{ $settings->get('group') ? 'wp-block-buttons--grouped' : 'wp-block-buttons--separated' }}">
  @unless($buttons->isEmpty())
    @if($settings->get('group'))
      <x-button.group>
        @foreach($buttons as $button)
          <x-button :href="$button->get('button')->url()" :target="$button->get('button')->target()" :theme="$button->get('theme')">
            {!! esc_html($button->get('button')->title()) !!}
          </x-button>
        @endforeach
      </x-button.group>
    @else
      @foreach($buttons as $button)
        <div>
          <x-button :href="$button->get('button')->url()" class="btn-{{ $button->get('size') }} flex-1" :target="$button->get('button')->target()" :theme="$button->get('theme')" :fancyboxType="\App\Services\Url::mediaType($button->get('button')->url())">
            {!! esc_html($button->get('button')->title()) !!}
          </x-button>
        </div>
      @endforeach
    @endif
  @else
    @if($block->preview)
      <p>{{ __('Add some buttons ...', 'sage') }}</p>
    @else
    <!-- {{ __('Add some buttons ...', 'sage') }} ... -->
    @endif
  @endunless
</x-block>
