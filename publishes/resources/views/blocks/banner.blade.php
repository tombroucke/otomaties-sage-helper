<x-block :block="$block" class="d-flex align-items-center {{ $textColor ?? '' }} {{ $backgroundColor ?? '' }}" :background="$backgroundImage ? $backgroundImage->url('large') : null">
  @if($block->block->align == 'full')
    <div class="container container--wide">
      <h1>{!! esc_html($title) !!}</h1>
    </div>
  @elseif($block->block->align == 'wide')
  <div class="container">
    <h1>{!! esc_html($title) !!}</h1>
  </div>
  @else
  <div class="w-100">
    <h1 class="px-3 px-md-5">{!! esc_html($title) !!}</h1>
  </div>
  @endif
</x-block>
