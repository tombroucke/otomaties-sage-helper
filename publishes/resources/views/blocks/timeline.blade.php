@if ($items->isNotEmpty())
  <x-block :block="$block">
    @foreach ($items as $key => $item)
      <div class="wp-block-timeline__item justify-content-lg-between">
        <div @class(['row', 'flex-row-reverse' => $key % 2 !== 0])>
          <div class="col-md-5 order-2 order-md-1">
            <h2>{!! $item['title'] !!}</h2>
            {!! wpautop($item['content']) !!}
          </div>
          <div class="col-md-2 text-center order-1 order-md-2 position-relative">
            <div class="wp-block-timeline__center">
              <div class="wp-block-timeline__year bg-primary text-white">
                {{ $item['year'] }}
              </div>
            </div>
          </div>
          <div class="col-md-5 order-3">
            {!! $item['image']->image('medium') !!}
          </div>
        </div>
      </div>
    @endforeach
  </x-block>
@else
  @preview($block)
    <p>{{ __('Add some items ...', 'sage') }}</p>
  @endpreview
@endif
