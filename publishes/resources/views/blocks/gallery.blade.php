@if ($gallery->isNotEmpty())
  <x-block :block="$block">
    <div class="row g-3">
      @foreach ($gallery as $image)
        <div class="col-sm-6 col-md-4 col-lg-3 flex-grow-1">
          <a
            data-fancybox="gallery-{{ $block->block->id }}"
            href="{{ $image->url('large') }}"
          >
            {!! $image->image('thumbnail') !!}
          </a>
        </div>
      @endforeach
    </div>
  </x-block>
@else
  @preview($block)
    <p>{{ __('Add some images ...', 'sage') }}</p>
  @endpreview
@endif
