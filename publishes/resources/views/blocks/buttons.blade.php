<x-block :block="$block">
  @if($buttons->isset())
    @if($settings->get('group'))
      <x-button.group>
        @foreach($buttons as $button)
          <x-button :href="$button->get('button')->url()" :target="$button->get('button')->target()" :theme="$button->get('style')">
            {!! $button->get('button')->title() !!}
          </x-button>
        @endforeach
      </x-button.group>
    @else
      @foreach($buttons as $button)
        <x-button :href="$button->get('button')->url()" :target="$button->get('button')->target()" :theme="$button->get('style')">
          {!! $button->get('button')->title() !!}
        </x-button>
      @endforeach
    @endif
  @else
    <p>{{ __('Add some buttons...', 'sage') }}</p>
  @endif
</x-block>
