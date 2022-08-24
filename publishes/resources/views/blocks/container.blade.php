<x-block :block="$block" class="{{ property_exists($block->block, 'backgroundColor') && $block->block->align !== 'full' ? 'px-3' : '' }}" :background="$backgroundImage">
  @if($block->block->align == 'full')
    <div class="container">
      <InnerBlocks />
    </div>
  @else
    <InnerBlocks />
  @endif
</x-block>
