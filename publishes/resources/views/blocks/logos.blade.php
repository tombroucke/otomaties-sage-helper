@if ($logos->isSet())
  <x-block :block="$block">
    @if($type == 'grid')
      @if($block->block->align && ($block->block->align == 'full' || $block->block->align == 'wide'))
        <div class="container-fluid py-3">
      @endif
      <div class="row g-3 align-items-center justify-content-center">
        @foreach ($logos as $logo)
          @if($logo->get('logo')->isSet())
            <div class="col-6 col-md-3 col-lg-2 text-center">
              @if($logo->get('link')->isSet())
                <a href="{{ $logo->get('link') }}">
                  {!! $logo->get('logo')->image('medium') !!}
                </a>
              @else
                {!! $logo->get('logo')->image('medium') !!}
              @endif
            </div>
          @endif
        @endforeach
      </div>
      @if($block->block->align && ($block->block->align == 'full' || $block->block->align == 'wide'))
        </div>
      @endif
    @else
      <div class="wp-block-logos__slider {{ $block->preview ? 'd-flex flex-nowrap' : '' }}" data-slick='{"dots":true, "slidesToShow":"3", "slidesToScroll":1, "autoplay":"true", "autoplaySpeed":"4000"}'>
        @foreach ($logos as $logo)
          @if($logo->get('logo')->isSet())
          <div class="slide text-center">
            @if($logo->get('link')->isSet())
              <a href="{{ $logo->get('link') }}">
                {!! $logo->get('logo')->image('medium') !!}
              </a>
            @else
              {!! $logo->get('logo')->image('medium') !!}
            @endif
          </div>
          @endif
        @endforeach
      </div>
    @endif
  </x-block>
@else
  @if($block->preview)
    <p>{{ __('Add some logos', 'sage') }}</p>
  @else
  <!-- {{ __('Add some logos', 'sage') }} ... -->
  @endif
@endif
