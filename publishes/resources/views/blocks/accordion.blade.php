@unless ($items->isEmpty())
  <x-block :block="$block">
    <x-collapse.accordion :id="$block->block->id">
      @foreach ($items as $item)
        <x-collapse.accordion.item
          accordion-id="{{ $block->block->id }}"
          :show="$loop->first && $openFirst"
        >
          {{-- Heading --}}
          <x-slot name="heading">
            {!! esc_html($item['question']) !!}
          </x-slot>

          {{-- Content --}}
          {!! $item['answer'] !!}
        </x-collapse.accordion.item>
      @endforeach
    </x-collapse.accordion>
  </x-block>
@else
  @preview($block)
    <p>{{ __('Add some accordion items ...', 'sage') }}</p>
  @endpreview
@endunless
