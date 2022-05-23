<x-block :block="$block" class="position-relative">
  @if($block->block->align == 'full')
    <div class="container-fluid px-0">
  @endif
    <div class="row {{ $imagePosition == 'left' ? 'flex-row-reverse' : '' }} {{ $block->block->align == 'full' ? 'mx-0' :'' }}">
      <div class="col-lg-6 py-5 {{ $imagePosition == 'left' ? 'ps-lg-0' : 'pe-lg-0' }} {{ $block->block->align == 'full' ? 'px-0' :'' }}">
        <div class="wp-block-image-content__content h-100 d-flex align-items-center">
          <div>
            <InnerBlocks />
          </div>
        </div>
      </div>
      <div class="col-lg-6 {{ $imagePosition == 'left' ? 'pe-lg-0' : 'ps-lg-0' }} {{ $block->block->align == 'full' ? 'px-0' :'' }}">
        <div class="wp-block-image-content__image">
          {!! $image->attributes()->image($imageSize) !!}
        </div>
      </div>
    </div>
  @if($block->block->align == 'full')
    </div>
  @endif
</x-block>
