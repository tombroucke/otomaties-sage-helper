@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @if ($latestPosts->have_posts())
    <div class="row justify-content-center">
      @while ($latestPosts->have_posts())
        @php($latestPosts->the_post())
        <div class="col-md-{{ 12 / $columnCount }}">
          @includeFirst(['partials.content-post', 'partials.content'])
        </div>
      @endwhile
    </div>

    <div class="mt-5 text-center">
      <x-button href="{{ $archiveLink }}">
        {{ esc_html(__('All posts', 'sage')) }}
      </x-button>
    </div>

    @includeWhen($showPagination, 'partials.pagination', [
        'wpQuery' => $latestPosts,
        'addFragment' => '#wp-block-latest-posts',
    ])
  @elseif ($block->preview)
    <p>{{ __('There are no posts', 'sage') }}</p>
  @endif

  @unless ($block->preview)
  </div>
@endunless
