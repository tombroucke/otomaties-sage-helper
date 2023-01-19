<x-block :block="$block">
  @unless($items->isEmpty())
    <div class="wp-block-hero-slider__slider">
      <div class="swiper">
        <div class="swiper-wrapper">
          @foreach($items as $item)
            <div class="swiper-slide">
              <div class="wp-block-hero-slider__item d-flex align-items-center {{ $item->get('settings')->get('text_color') != '' ? 'text-' . $item->get('settings')->get('text_color') : '' }} {{ $item->get('settings')->get('content_position') != 'right' ? '' : 'justify-content-end text-right' }}" @background($item->get('background_image')->default(\Roots\asset('images/hero.jpg')->uri())->url('large'))>
                @if($block->block->align == 'full')
                  <div class="container container--wide py-5">
                @else
                  <div class="p-5">
                @endif

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
                            <x-button :href="$button->get('button')->url()" :target="$button->get('button')->target()" :theme="$button->get('theme')">
                              {!! esc_html($button->get('button')->title()) !!}
                            </x-button>
                          @endforeach
                        </x-button.group>

                      {{-- Regular buttons --}}
                      @else
                        @foreach($item->get('buttons') as $button)
                          <x-button :href="$button->get('button')->url()" :target="$button->get('button')->target()" :theme="$button->get('theme')">
                            {!! esc_html($button->get('button')->title()) !!}
                          </x-button>
                        @endforeach
                      @endif
                    </div>
                  @endif
                @if($block->block->align == 'full')
                  </div>
                @else
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @else
    @if($block->preview)
      <p>{{ __('Add some slides ...', 'sage') }}</p>
    @else
    <!-- {{ __('Add some slides ...', 'sage') }} ... -->
    @endif
  @endunless
</x-block>
