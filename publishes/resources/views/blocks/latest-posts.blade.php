@if($latestPosts->have_posts())
  <x-block :block="$block" id="wp-block-latest-posts">
    @while($latestPosts->have_posts()) @php($latestPosts->the_post())
      @includeFirst(['partials.content-post', 'partials.content'])
    @endwhile

    <x-button href="{{ get_post_type_archive_link('post') }}">
      {!! esc_html(__('All posts', 'sage')) !!}
    </x-button>

    @if($showPagination)
      @include('partials.pagination', ['wpQuery' => $latestPosts, 'addFragment' => '#wp-block-latest-posts'])
    @endif
  </x-block>
@else
  @if($block->preview)
    <p>{{ __('There are no posts', 'sage') }}</p>
  @else
  <!-- {{ __('There are no posts', 'sage') }} ... -->
  @endif
@endif
