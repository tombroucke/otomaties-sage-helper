<x-block :block="$block" class="bg-{{ $backgroundColor }} text-{{ $textColor }}">
  @if(!$block->block->align || $block->block->align == '')
    <InnerBlocks />
  @else
    <div class="container">
      <InnerBlocks />
    </div>
  @endif
</x-block>
