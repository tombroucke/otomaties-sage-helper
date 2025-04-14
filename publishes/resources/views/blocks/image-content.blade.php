@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  <div
    @class([
        'wp-block-image-content__image position-relative',
        'align-self-stretch' => $stretchImage,
    ])
    @style(['grid-column: ' . $imageGridColumn, 'grid-row: 1'])
  >
    {!! $image->attributes([
            'class' => collect($imageClasses)->merge(['w-100'])->join(' '),
        ])->image('large') !!}
  </div>

  <div
    class="wp-block-image-content__content"
    @style(['grid-column: ' . $contentGridColumn, 'grid-row: 1'])
  >
    <InnerBlocks template="{{ $block->template }}" />
  </div>

  @unless ($block->preview)
  </div>
@endunless
