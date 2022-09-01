<x-block :block="$block">
  @unless ($items->isEmpty())
    @foreach ($items as $key => $item)
      <div class="wp-block-timeline__item justify-content-lg-between">
        <div class="row {{ $key % 2 !== 0 ? 'flex-row-reverse' : '' }}">
          <div class="col-md-5 order-2 order-md-1">
            <h2>{!! $item->get('title') !!}</h2>
            {!! wpautop($item->get('content')) !!}
          </div>
          <div class="col-md-2 text-center order-1 order-md-2 position-relative">
            <div class="wp-block-timeline__center">
              <div class="wp-block-timeline__year bg-primary text-white">
                {{ $item->get('year') }}
              </div>
            </div>
          </div>
          <div class="col-md-5 order-3">
            {!! $item->get('image')->image('medium') !!}
          </div>
        </div>
      </div>
    @endforeach
  @else
    @if($block->preview)
      <p>{{ __('Add some items ...', 'sage') }}</p>
    @else
      <!-- {{ __('Add some items ...', 'sage') }} ... -->
    @endif
  @endunless
</x-block>
