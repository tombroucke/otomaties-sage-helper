<x-block :block="$block" class="position-relative {{ $block->block->align ? 'wp-block-image-content--' . $block->block->align : '' }}">
  <div class="wp-block-image-content__image {{ $imagePosition == 'left' ? 'wp-block-image-content__image--left' : 'wp-block-image-content__image--right' }}" @background($image->url($imageSize))>
    {!! $image->attributes(['class' => 'd-lg-none'])->image($imageSize) !!}
  </div>
  @if($block->block->align && ($block->block->align == 'full' || $block->block->align == 'wide'))
    <div class="container">
  @endif
  <div class="row {{ $imagePosition == 'left' ? 'flex-row-reverse' : '' }} align-items-center">
    <div class="col-lg-6">
      <div class="wp-block-image-content__content {{ $imagePosition == 'left' ? 'wp-block-image-content__content--right' : 'wp-block-image-content__content--left' }}">
        <div>
          <InnerBlocks />
        </div>
      </div>
    </div>
  </div>
  @if($block->block->align && ($block->block->align == 'full' || $block->block->align == 'wide'))
  </div>
  @endif
</x-block>
