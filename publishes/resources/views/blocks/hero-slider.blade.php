<x-block :block="$block">
  @foreach($items as $item)
    <div class="wp-block-hero-slider__item d-flex align-items-center {{ $item->get('settings')->get('text_color') ? 'text-' . $item->get('settings')->get('text_color') : '' }} {{ $item->get('settings')->get('content_position') != 'right' ? '' : 'justify-content-end text-right' }}" @background($item->get('background_image')->default(\Roots\asset('images/hero.jpg')->uri())->url('large'))>
      <div class="container">

        {{-- Header --}}
        <div class="wp-block-hero-slider__heading">
          <h1>{{ $item->get('title')->default(__('Add a title', 'sage')) }}</h1>
          @if($item->get('subtitle'))
            <h2>{{ $item->get('subtitle') }}</h2>
          @endif
        </div>

        {{-- Buttons --}}
        @if($item->get('buttons')->isset())
          <div class="wp-block-hero-slider__buttons">

            {{-- Button group --}}
            @if($item->get('settings')->get('group_buttons'))
              <x-button.group>
                @foreach($item->get('buttons') as $button)
                  <x-button :href="$button->get('button')->url()" :target="$button->get('button')->target()" :theme="$button->get('style')">
                    {!! $button->get('button')->title() !!}
                  </x-button>
                @endforeach
              </x-button.group>

            {{-- Regular buttons --}}
            @else
              @foreach($item->get('buttons') as $button)
                <x-button :href="$button->get('button')->url()" :target="$button->get('button')->target()" :theme="$button->get('style')">
                  {!! $button->get('button')->title() !!}
                </x-button>
              @endforeach
            @endif
          </div>
        @endif

      </div>
    </div>
  @endforeach
</x-block>
