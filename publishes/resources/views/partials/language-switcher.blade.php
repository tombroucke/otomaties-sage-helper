@if (!empty($languages))
  <li class="menu-item menu-item--has-submenu {{ $classes ?? '' }} menu-item--language-switcher">
    <span class="menu-item__link">
      <img src="@asset('images/' . strtolower( $activeLanguage['tag'] ) . '.png')" alt="{!! $activeLanguage['native_name'] !!}">{!! $activeLanguage['native_name'] !!}
      <x-icon name="chevron-down fa-xs" />	
    </span>
    <ul class="submenu">
      @foreach ($languages as $language)
        <li>
          <a class="menu-item__link" href="{{ $language['url'] }}" title="{{ $language['native_name'] }}"><img src="@asset('images/' . strtolower( $language['tag'] ) . '.png')" alt="{!! $language['native_name'] !!}">{{ $language['native_name'] }}</a>
        </li>
      @endforeach
    </ul>
  </li>
@endif
