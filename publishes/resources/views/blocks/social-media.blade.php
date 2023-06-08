@if(count($socialMedia) > 0)
<x-block :block="$block">
    @foreach($socialMedia as $social)
      <a href="{{ $social['link'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['title'] }}">
        <x-icon :name="'fab-' . $social['icon']" width="30" height="30"/>
      </a>
    @endforeach
</x-block>
@else
  @if($block->preview)
    <p>{{ __('Add some social media ...', 'sage') }}</p>
  @else
  <!-- {{ __('Add some social media ...', 'sage') }} -->
  @endif
@endif
