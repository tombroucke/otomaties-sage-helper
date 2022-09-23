@if ($logos->isSet())
  <x-block :block="$block">
    <div class="swiper">
      <div class="{{ $block->preview ? 'd-flex flex-nowrap' : '' }} swiper-wrapper">
        @foreach ($logos as $logo)
          @if($logo->get('logo')->isSet())
          <div class="swiper-slide text-center">
            @if($logo->get('link')->isSet())
              <a href="{{ $logo->get('link') }}">
                {!! ResponsivePics::get_image($logo->get('logo')->getId(), 'xs-2') !!}
              </a>
            @else
              {!! ResponsivePics::get_image($logo->get('logo')->getId(), 'xs-2') !!}
            @endif
          </div>
          @endif
        @endforeach
      </div>
    </div>
  </x-block>
@else
  @if($block->preview)
    <p>{{ __('Add some logos', 'sage') }}</p>
  @else
  <!-- {{ __('Add some logos', 'sage') }} ... -->
  @endif
@endif
