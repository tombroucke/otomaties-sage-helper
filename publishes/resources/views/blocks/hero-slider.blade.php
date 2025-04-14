@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

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
                <div class="container--wide container">

                  {{-- Header --}}
                  <div class="wp-block-hero-slider__heading">
                    <h1>{!! wp_kses($item['title']->default($block->preview ? __('Add a title', 'sage') : ''), $allowedInlineTags()) !!}</h1>
                    @if ($item['subtitle'])
                      <h2>{!! wp_kses($item['subtitle'], $allowedInlineTags()) !!}</h2>
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
                              :href="esc_url($button['button']->url())"
                              :target="esc_attr($button['button']->target())"
                              :theme="esc_attr($button['theme'])"
                            >
                              {!! wp_kses(html_entity_decode($button['button']->title()), $allowedInlineTags()) !!}
                            </x-button>
                          @endforeach
                        </x-button.group>
                      @else
                        @foreach ($item['buttons'] as $button)
                          <x-button
                            :href="esc_url($button['button']->url())"
                            :target="esc_attr($button['button']->target())"
                            :theme="esc_attr($button['theme'])"
                          >
                            {!! wp_kses(html_entity_decode($button['button']->title()), $allowedInlineTags()) !!}
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
  @elseif ($block->preview)
    <p>{{ __('Add some slides ...', 'sage') }}</p>
  @endunless

  @unless ($block->preview)
  </div>
@endunless
