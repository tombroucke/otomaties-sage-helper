<x-block :block="$block">
  @unless ($items->isEmpty())
    <div class="wp-block-hero-slider__slider">
      <div class="swiper">
        <div class="swiper-wrapper">
          @foreach ($items as $item)
            <div class="swiper-slide">
              <div
                @class([
                    'spacing-outer wp-block-hero-slider__item d-flex align-items-center',
                    'text-' . $item['settings']->get('text_color') =>
                        $item['settings']->get('text_color') != '',
                    'justify-content-end text-right' =>
                        $item['settings']->get('content_position') == 'right',
                ])
                @background($item['background_image']->default(\Roots\asset('images/hero.jpg')->uri())->url('large'))
              >
                <div class="container container--wide">
                  {{-- Header --}}
                  <div class="wp-block-hero-slider__heading">
                    <h1>{{ $item['title']->default($block->preview ? __('Add a title', 'sage') : '') }}</h1>
                    @if ($item['subtitle'])
                      <h2>{{ $item['subtitle'] }}</h2>
                    @endif
                  </div>

                  {{-- Buttons --}}
                  @if ($item['buttons']->isNotEmpty())
                    <div class="wp-block-hero-slider__buttons">

                      {{-- Button group --}}
                      @if ($item['settings']->get('group_buttons'))
                        <x-button.group>
                          @foreach ($item['buttons'] as $button)
                            <x-button
                              :href="$button->get('button')->url()"
                              :target="$button->get('button')->target()"
                              :theme="$button->get('theme')"
                            >
                              {!! esc_html($button->get('button')->title()) !!}
                            </x-button>
                          @endforeach
                        </x-button.group>

                        {{-- Regular buttons --}}
                      @else
                        @foreach ($item['buttons'] as $button)
                          <x-button
                            :href="$button->get('button')->url()"
                            :target="$button->get('button')->target()"
                            :theme="$button->get('theme')"
                          >
                            {!! esc_html($button->get('button')->title()) !!}
                          </x-button>
                        @endforeach
                      @endif
                    </div>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @else
    @preview($block)
      <p>{{ __('Add some slides ...', 'sage') }}</p>
    @endpreview
  @endunless
</x-block>
