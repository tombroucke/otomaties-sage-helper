@if ($subpages)
  <x-block :block="$block">
    <x-list-group>
      @foreach ($subpages as $subpage)
        <x-list-group.link :href="get_permalink($subpage->ID)">
          {!! $subpage->post_title !!}
        </x-list-group.link>
      @endforeach
    </x-list-group>
  </x-block>
@else
  @preview($block)
    <p>{{ __('No subpages found for this page', 'sage') }}</p>
  @endpreview
@endif
