<x-block :block="$block" class="bg-{{ $backgroundColor }}">
  @if( ( $block->block->align == 'full' || $block->block->align == 'wide' ) && !is_admin())
    <div class="container">
      <InnerBlocks />
    </div>
  @else
    <InnerBlocks />
  @endif
</x-block>
