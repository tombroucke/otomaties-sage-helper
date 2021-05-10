<x-block class="d-flex align-items-center {{ $settings->get('text_color') ? 'text-' . $settings->get('text_color') : '' }}" :block="$block" :background="$background_image->url('large')">
  <div class="container">
    <InnerBlocks />
  </div>
</x-block>
