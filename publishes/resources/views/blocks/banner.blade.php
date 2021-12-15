<x-block :block="$block" class="d-flex align-items-center {{ $textColor ?? '' }} {{ $backgroundColor ?? '' }}" :background="$backgroundImage ? $backgroundImage->url('large') : null">
  @if(!$block->block->align || $block->block->align == '')
    <h1>{!! $title !!}</h1>
  @else
    <div class="container">
      <h1>{!! $title !!}</h1>
    </div>
  @endif
</x-block>
