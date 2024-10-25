<x-block
  @class(['d-flex', $verticalAlignClass])
  :block="$block"
>
  <div class="wp-block-hero__background">
    {!! $backgroundImage !!}
  </div>
  <div class="container container--wide">
    <InnerBlocks />
  </div>
</x-block>
