<x-block :block="$block" class="bg-{{ $backgroundColor }}">
  <div class="row {{ $imagePosition == 'right' ? 'flex-row-reverse' : '' }}">
    <div class="wp-block-image-content__image col-md-6">
      <div class="h-100" @background($image->url('medium'))>
        {!! $image->attributes(['class' => 'd-md-none'])->image('medium') !!}
      </div>
    </div>
    <div class="wp-block-image-content__content col-md-6 d-flex align-items-center p-3 p-md-5">
      <InnerBlocks />
    </div>
  </div>
</x-block>
