@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @if ($subpages)
    <x-list-group>
      @foreach ($subpages as $subpage)
        <x-list-group.link :href="get_permalink($subpage->ID)">
          {!! esc_html($subpage->post_title) !!}
        </x-list-group.link>
      @endforeach
    </x-list-group>
  @else
    @if ($block->preview)
      <p>{{ __('No subpages found for this page', 'sage') }}</p>
    @endif
  @endif

  @unless ($block->preview)
  </div>
@endunless
