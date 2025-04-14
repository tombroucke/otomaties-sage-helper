@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  <div class="w-100">
    <h1 class="py-md-4 w-100 mb-0 py-3">{!! wp_kses($title, $allowedInlineTags()) !!}</h1>
  </div>

  @unless ($block->preview)
  </div>
@endunless
