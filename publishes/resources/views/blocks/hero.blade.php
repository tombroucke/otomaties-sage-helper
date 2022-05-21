<x-block class="d-flex align-items-center" :block="$block" :background="$backgroundImage ? $backgroundImage->url('large') : null">
  <div class="container">
    <InnerBlocks />
  </div>
</x-block>
