@if(!empty($channels))
  <ul class="social-media d-flex gap-2 list-unstyled">
    @foreach($channels as $channel)
      <li>
        <a href="{{ $channel['link'] }}" target="_blank" aria-label="{{ $channel['label'] }}">
          <x-icon :name="'fab-' . $channel['icon']" width="1.2em" height="1.2em"/>
        </a>
      </li>
    @endforeach
  </ul>
@endif
