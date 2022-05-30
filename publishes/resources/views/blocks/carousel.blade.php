@if(!$slides->empty())
  <x-block :block="$block">
    <div class="wp-block-carousel__slider">
      @foreach($slides as $slide)
        <div class="slide">
          {!! $slide->get('image')->default('https://picsum.photos/500/300')->image('large') !!}
          {!! esc_html($slide->get('title')) !!}
        </div>
      @endforeach
    </div>
  </x-block>
@else
  @if($block->preview)
    <p>{{ __('Add some slides ...', 'sage') }}</p>
  @else
  <!-- {{ __('Add some slides ...', 'sage') }} ... -->
  @endif
@endif
