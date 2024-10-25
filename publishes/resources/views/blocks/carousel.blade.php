<x-block
  @class([
      'position-relative',
      'wp-block-carousel--navigation' => $navigation,
  ])
  :block="$block"
>
  <div
    class="swiper"
    data-uid="{{ $uid }}"
    data-settings="{{ $settings }}"
    data-breakpoints="{{ $breakpoints }}"
    data-loop="{{ $loop }}"
    data-centered-slides="{{ $centeredSlides }}"
  >
    <div class="swiper-wrapper">
      @foreach ($slides as $slide)
        <div class="swiper-slide">
          <div class="wp-block-carousel__image h-100">
            @if (strpos($slide['image']->url(), '.gif') !== false)
              {!! $slide['image']->attributes(['class' => 'h-100 w-100 object-fit-cover'])->image('full') !!}
            @else
              {!! $slide['image']->attributes(['class' => 'h-100 w-100 object-fit-cover'])->default('https://picsum.photos/1920/1080')->image('large') !!}
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @if ($navigation)
    <x-button
      class="swiper-button swiper-button-prev position-absolute z-2 btn-sm p-3"
      id="swiper-button-prev-{{ $uid }}"
      tag="button"
      href="#"
      theme="white"
    >
      <x-fas-angle-left height="1.5em" />
    </x-button>
    <x-button
      class="swiper-button swiper-button-next position-absolute z-2 btn-sm p-3"
      id="swiper-button-next-{{ $uid }}"
      tag="button"
      href="#"
      theme="white"
    >
      <x-fas-angle-right height="1.5em" />
    </x-button>
  @endif
</x-block>
