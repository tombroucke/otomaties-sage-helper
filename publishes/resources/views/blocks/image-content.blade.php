<x-block :block="$block" class="position-relative">
  @if($block->block->align == 'full')
    <div class="container-fluid px-0">
  @endif
  <div class="row {{ $imagePosition == 'left' ? 'flex-row-reverse' : '' }} {{ $block->block->align == 'full' ? 'mx-0' :'' }} {{ $verticalAlignClass }} justify-content-between">
    <div class="{{ $firstColumnClasses }} {{ $block->block->align == 'full' ? 'px-0' :'' }} mb-4 mb-md-0">
      <div class="wp-block-image-content__content">
        <div>
          <InnerBlocks />
        </div>
      </div>
    </div>
    <div class="{{ $secondColumnClasses }} {{ $block->block->align == 'full' ? 'px-0' :'' }}">
      <div class="wp-block-image-content__image">
        @if($image->getId())
          @if(strpos($image->url(), '.gif') !== false)
            {!! $image->image('full') !!}
          @else
            {!! $image->image($imageSize) !!}
          @endif
        @else
          {!! $image->image($imageSize) !!}
        @endif
      </div>
    </div>
  </div>
  @if($block->block->align == 'full')
    </div>
  @endif
</x-block>
