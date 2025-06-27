@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  <div class="wp-block-hero__background mw-100">
    {!! $backgroundImage !!}
  </div>

  <InnerBlocks
    @class([
        'wp-block-hero__content alignwide w-100',
        // 'px-root' => $needsBleed,
    ])
    template="{{ $block->template }}"
  />

  @unless ($block->preview)
  </div>
@endunless
