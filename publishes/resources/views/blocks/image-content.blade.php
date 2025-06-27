@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  <div
    @class([
        'wp-block-image-content__image position-relative',
        'align-self-stretch' => $stretchImage,
    ])
    @style([$imageStyles])
  >
    {!! $image->attributes([
            'class' => collect($imageClasses)->merge(['w-100'])->join(' '),
        ])->image('large') !!}
  </div>

  <div
    @class([
        'wp-block-image-content__content',
        'py-4 py-md-5',
        'p-4 p-md-5' => $hasBackgroundColor,
        'ps-md-5' => $imagePosition == 'left',
        'pe-md-5' => $imagePosition == 'right',
        'ps-md-0' => $imagePosition == 'right' && $block->block->align === 'full',
        'pe-md-0' => $imagePosition == 'left' && $block->block->align === 'full',
    ])
    @style([$contentStyles])
  >
    <InnerBlocks
      class="wp-block-image-content__content__blocks"
      template="{{ $block->template }}"
    />
  </div>

  @unless ($block->preview)
  </div>
@endunless
