@if ($latestPosts->have_posts())
  <x-block
    id="wp-block-latest-posts"
    :block="$block"
  >
    @while ($latestPosts->have_posts())
      @php($latestPosts->the_post())
      @includeFirst(['partials.content-post', 'partials.content'])
    @endwhile

    <x-button href="{{ $archiveLink }}">
      {!! esc_html(__('All posts', 'sage')) !!}
    </x-button>

    @includeWhen($showPagination, 'partials.pagination', [
        'wpQuery' => $latestPosts,
        'addFragment' => '#wp-block-latest-posts',
    ])
  </x-block>
@else
  @preview($block)
    <p>{{ __('There are no posts', 'sage') }}</p>
  @endpreview
@endif
