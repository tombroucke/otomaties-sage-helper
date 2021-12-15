<x-block :block="$block" class="d-block">
  @unless($buttons->isEmpty())
    @if($settings->get('group'))
      <x-button.group>
    @endif
      @foreach($buttons as $button)
        <x-button :href="$button->get('button')->url()" :target="$button->get('button')->target()" :theme="$theme">
          {!! $button->get('button')->title() !!}
        </x-button>
      @endforeach
    @if($settings->get('group'))
      </x-button.group>
    @endif
  @else
    <p>{{ __('Add some buttons...', 'sage') }}</p>
  @endunless
</x-block>
