<x-block
  @class(['d-flex align-items-center'])
  :block="$block"
  :background="$backgroundImage ? $backgroundImage->url('large') : null"
>
  <div class="w-100">
    <h1 class="p-3 px-md-5 py-md-4 mb-0">{!! esc_html($title) !!}</h1>
  </div>
</x-block>
