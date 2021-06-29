@if ($navigation)
  <nav class="nav-primary">
    <ul>
      @foreach ($navigation as $item)
        <li class="{{ $item->classes ?? '' }} {{ $item->active ? 'active' : '' }} {{ $item->children ? 'menu-item--has-submenu' : '' }}">
          <a href="{{ $item->url }}">
            {{ $item->label }}
          </a>

          @if ($item->children)
            <ul class="submenu">
              @foreach ($item->children as $child)
                <li class="{{ $child->classes ?? '' }} {{ $child->active ? 'active' : '' }}">
                  <a href="{{ $child->url }}">
                    {{ $child->label }}
                  </a>
                </li>
              @endforeach
            </ul>
          @endif
        </li>
      @endforeach
    </ul>
  </nav>
  <button class="d-xl-none navbar-toggler btn">
    <div>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </button>
@endif
