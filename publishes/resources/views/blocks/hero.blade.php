@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  <div class="wp-block-hero__background">
    {!! $backgroundImage !!}
  </div>
  <div class="container--wide container">
    <InnerBlocks template="{{ $block->template }}" />
  </div>

  @unless ($block->preview)
  </div>
@endunless
