@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @if ($postTypeQuery->have_posts())
    <div class="row justify-content-center">
      @while ($postTypeQuery->have_posts())
        @php($postTypeQuery->the_post())
        <div class="col-md-{{ 12 / $columnCount }}">
          @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
        </div>
      @endwhile
    </div>

    @include('partials.pagination', ['wpQuery' => $postTypeQuery])
  @endif

  @unless ($block->preview)
  </div>
@endunless
