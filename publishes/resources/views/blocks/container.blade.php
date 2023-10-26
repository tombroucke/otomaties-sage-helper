<x-block :block="$block" :background="$backgroundImage">
  @if($block->block->align == 'full')
  <div class="spacing-outer">
    <div class="container">
      <InnerBlocks />
    </div>
  </div>
  @else
    @if(property_exists($block->block, 'backgroundColor'))
      <div class="spacing-outer">
        <InnerBlocks />
      </div>
    @else
    <InnerBlocks />
    @endif
  @endif
</x-block>
