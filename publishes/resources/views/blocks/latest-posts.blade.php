@if($latestPosts->have_posts())
  <x-block :block="$block">
    <div class="row">
      @while($latestPosts->have_posts()) @php($latestPosts->the_post())
        @includeFirst(['partials.content-post', 'partials.content'])
      @endwhile
    </div>
  </x-block>
@else
  @if($block->preview)
    <p>{{ __('There are no posts', 'sage') }}</p>
  @else
  <!-- {{ __('There are no posts', 'sage') }} ... -->
  @endif
@endif
