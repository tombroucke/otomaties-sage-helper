@if ($navigation)
  <nav class="nav-primary">
    <ul class="list-unstyled">
      @foreach ($navigation as $item)
      <li class="menu-item {{ $item->classes ?? '' }} {{ $item->active ? 'menu-item--active' : '' }} {{ $item->children ? 'menu-item--has-submenu' : '' }}">
        <a href="{{ $item->url }}">
            {{ $item->label }}
          </a>
          @if ($item->children)
            <ul class="submenu list-unstyled">
              @foreach ($item->children as $child)
                <li class="submenu-item {{ $child->classes ?? '' }} {{ $child->active ? 'submenu-item--active' : '' }}">
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
