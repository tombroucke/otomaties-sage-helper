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
    @if($block->preview)
      <p>{{ __('Add some buttons ...', 'sage') }}</p>
    @else
    <!-- {{ __('Add some buttons ...', 'sage') }} ... -->
    @endif
  @endunless
</x-block>
