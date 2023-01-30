@if(!$slides->empty())
  <x-block :block="$block">
    <div class="swiper">
      <div class="swiper-wrapper">
        @foreach($slides as $slide)
          <div class="swiper-slide">
            <div class="wp-block-carousel__image">
              @if($slide->get('image')->isSet())
                @if(strpos($slide->get('image')->url(), '.gif') !== false)
                  {!! $slide->get('image')->image('full') !!}
                @else
                  {!! ResponsivePics::get_image($slide->get('image')->getId(), 'lg-12', 0.5625) !!}
                @endif
              @else
                {!! $slide->get('image')->default('https://picsum.photos/1920/1080')->image('large') !!}
              @endif
            </div>
            <div class="wp-block-carousel__title">
              {!! esc_html($slide->get('title')) !!}
            </div>
          </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
      <x-button class="swiper-button swiper-button-prev">
        {!! __('Previous', 'sage') !!}
      </x-button>
      <x-button class="swiper-button swiper-button-next">
        {!! __('Next', 'sage') !!}
      </x-button>
    </div>
  </x-block>
@else
  @if($block->preview)
    <p>{{ __('Add some slides ...', 'sage') }}</p>
  @else
  <!-- {{ __('Add some slides ...', 'sage') }} ... -->
  @endif
@endif
