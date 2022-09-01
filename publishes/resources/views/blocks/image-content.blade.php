<x-block :block="$block" class="position-relative">
  @if($block->block->align == 'full')
    <div class="container-fluid px-0">
  @endif
    <div class="row {{ $imagePosition == 'left' ? 'flex-row-reverse' : '' }} {{ $block->block->align == 'full' ? 'mx-0' :'' }} {{ $verticalAlignClass }}">
      <div class="col-md-6 {{ $block->block->align == 'full' ? 'px-0' :'' }} mb-4 mb-md-0">
        <div class="wp-block-image-content__content">
          <div>
            <InnerBlocks />
          </div>
        </div>
      </div>
      <div class="col-md-6 {{ $block->block->align == 'full' ? 'px-0' :'' }}">
        <div class="wp-block-image-content__image">
          {!! $image->attributes()->image($imageSize) !!}
        </div>
      </div>
    </div>
  @if($block->block->align == 'full')
    </div>
  @endif
</x-block>
