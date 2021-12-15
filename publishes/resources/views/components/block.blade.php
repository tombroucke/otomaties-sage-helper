@unless(is_admin())
  @if($extendsOutsideContainer())
    </div>
  @endif
  @if($wide())
    <div class="{{ $containerClass }} {{ $containerClass }}--wide">
  @endif
@endunless

  <div {{ $attributes->merge(array_filter($defaultAttributes())) }} @if($background) @background($background) @endif>
    {{ $slot }}
  </div>

@unless(is_admin())
  @if($wide())
    </div>
  @endif
  @if($extendsOutsideContainer())
    <div class="{{ $containerClass }}">
  @endif
@endunless
