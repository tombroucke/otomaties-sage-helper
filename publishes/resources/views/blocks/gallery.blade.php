@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @if ($gallery->isNotEmpty())
    <div class="row g-3 justify-content-center">
      @foreach ($gallery as $image)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <a
            data-fancybox="gallery-{{ esc_attr($block->block->id) }}"
            href="{{ esc_url($image->url('large')) }}"
          >
            {!! $image->attributes(['class' => 'w-100'])->image('thumbnail') !!}
          </a>
        </div>
      @endforeach
    </div>
  @elseif ($block->preview)
    <p>{{ __('Add some images ...', 'sage') }}</p>
  @endif

  @unless ($block->preview)
  </div>
@endunless
