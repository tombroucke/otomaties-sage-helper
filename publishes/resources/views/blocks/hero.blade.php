<x-block class="d-flex align-items-center" :block="$block">
  <div class="wp-block-hero__background">
    {!! $backgroundImage !!}
  </div>
  <div class="container container--wide">
    <InnerBlocks />
  </div>
</x-block>
