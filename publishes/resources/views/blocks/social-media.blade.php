@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @include('partials.social-media')

  @unless ($block->preview)
  </div>
@endunless
