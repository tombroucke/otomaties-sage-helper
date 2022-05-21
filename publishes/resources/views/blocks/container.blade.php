<x-block :block="$block">
  @if(!$block->block->align || $block->block->align == '')
    <InnerBlocks />
  @else
    <div class="container">
      <InnerBlocks />
    </div>
  @endif
</x-block>
