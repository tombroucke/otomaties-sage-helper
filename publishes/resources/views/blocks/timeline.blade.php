@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @if ($items->isNotEmpty())
    @foreach ($items as $key => $item)
      <div class="wp-block-timeline__item justify-content-lg-between">
        <div @class(['row', 'flex-row-reverse' => $key % 2 !== 0])>

          <div class="col-md-5 order-md-1 order-2">
            <h2>{!! wp_kses($item['title'], $allowedInlineTags()) !!}</h2>
            {!! wpautop(wp_kses($item['content'], $allowedTinyMceTags())) !!}
          </div>

          <div class="col-md-2 order-md-2 position-relative order-1 text-center">
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
  @elseif ($block->preview)
    <p>{{ __('Add some items ...', 'sage') }}</p>
  @endif

  @unless ($block->preview)
  </div>
@endunless
