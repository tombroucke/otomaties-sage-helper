@unless ($buttons->isEmpty())
  <x-block
    @class(['d-flex gap-1', 'flex-column' => !$settings->get('group')])
    :block="$block"
  >
    @echoWhen($settings->get('group'), '<div class="btn-group" role="group">')
    @foreach ($buttons as $button)
      <div>
        <x-button
          :href="$button['button']->url()"
          :target="$button['button']->target()"
          :theme="$button['theme']"
        >
          {!! esc_html($button['button']->title()) !!}
        </x-button>
      </div>
    @endforeach
    @echoWhen($settings->get('group'), '</div>')
  </x-block>
@else
  @preview($block)
    <x-button
      href="#"
      theme="transparent"
    >
      {!! __('Add a button (sidebar)', 'sage') !!}
    </x-button>
  @endpreview
@endunless
