@props([
  'block' => new stdclass,
  'background' => false,
])
@if( ( $block->block->align == 'full' || $block->block->align == 'wide' ) && !is_admin())
</div>
@endif

@if( ( $block->block->align == 'wide' ) && !is_admin() )
  <div class="container container-large">
@endif

  <div {!! isset($block->block->anchor) ? 'id="' . $block->block->anchor . '"' : '' !!} {{ $attributes->merge(['class' => 'block ' . $block->classes]) }} @if($background) @background($background) @endif>
    {{ $slot }}
  </div>

@if( ( $block->block->align == 'wide' ) && !is_admin() )
  </div>
@endif

@if( ( $block->block->align == 'full' || $block->block->align == 'wide' ) && !is_admin())
  <div class="container">
@endif
