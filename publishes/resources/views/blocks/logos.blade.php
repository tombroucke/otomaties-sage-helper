@if ($logos->isSet())
  <x-block :block="$block">
    @if($type == 'grid')
      <div class="row g-3 align-items-center justify-content-center">
        @foreach ($logos as $logo)
          @if($logo->get('logo')->isSet())
            <div class="col text-center">
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
    @else
      <div class="wp-block-logos__slider" data-slick='{"dots":true, "slidesToShow":"3", "slidesToScroll":1, "autoplay":"true", "autoplaySpeed":"4000"}'>
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
