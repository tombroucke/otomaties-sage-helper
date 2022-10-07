@if(!$gallery->empty())
  <x-block :block="$block">
    <div class="row g-3">
      @foreach($gallery as $image)
        <div class="col-sm-6 col-md-4 col-lg-3 flex-grow-1">
          <a href="{{ $image->url('large') }}" data-fancybox="gallery-{{ $block->block->id }}">
            {!! ResponsivePics::get_image($image->getId(), 'xs-12, md-4', 1, 'w-100') !!}
          </a>
        </div>
      @endforeach
    </div>
  </x-block>
@else
  @if($block->preview)
    <p>{{ __('Add some images ...', 'sage') }}</p>
  @else
  <!-- {{ __('Add some images ...', 'sage') }} ... -->
  @endif
@endif
