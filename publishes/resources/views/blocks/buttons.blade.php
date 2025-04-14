@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @unless ($buttons->isEmpty())
    <div class="d-inline-flex gap-3">
      @foreach ($buttons as $button)
        <x-button
          :href="esc_url($button['button']->url())"
          :target="esc_attr($button['button']->target())"
          :theme="esc_attr($button['theme'])"
        >
          {!! wp_kses(html_entity_decode($button['button']->title()), $allowedInlineTags()) !!}
        </x-button>
      @endforeach
    </div>
  @elseif ($block->preview)
    <p>{{ __('Add some buttons ...', 'sage') }}</p>
  @endunless

  @unless ($block->preview)
  </div>
@endunless
