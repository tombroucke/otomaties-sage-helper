@if ($logos->isNotEmpty())
  <x-block :block="$block">
    @if ('carousel' == $type)
      <div class="swiper">
        <div @class(['swiper-wrapper', 'd-flex flex-nowrap' => $block->preview])>
          @foreach ($logos as $logo)
            <div class="swiper-slide">
              @echoWhen($logo['link']->isSet(), '<a href="' . $logo['link'] . '" target="_blank">')
              {!! $logo['logo']->image('medium') !!}
              @echoWhen($logo['link']->isSet(), '</a>')
            </div>
          @endforeach
        </div>
      </div>
    @else
      <div class="row g-5">
        @foreach ($logos as $logo)
          <div class="col-6 col-md-4 col-lg-3">
            @echoWhen($logo['link']->isSet(), '<a href="' . $logo['link'] . '" target="_blank">')
            {!! $logo['logo']->image('medium') !!}
            @echoWhen($logo['link']->isSet(), '</a>')
          </div>
        @endforeach
      </div>
    @endif
  </x-block>
@else
  @preview($block)
    <p>{{ __('Add some logos', 'sage') }}</p>
  @endpreview
@endif
