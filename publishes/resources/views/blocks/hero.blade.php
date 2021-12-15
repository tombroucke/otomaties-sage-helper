<x-block class="d-flex align-items-center {{ $textColor ?? '' }} {{ $backgroundColor ?? '' }}" :block="$block" :background="$backgroundImage ? $backgroundImage->url('large') : null">
  <div class="container">
    <InnerBlocks />
  </div>
</x-block>
