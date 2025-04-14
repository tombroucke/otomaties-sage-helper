@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @unless ($items->isEmpty())
    <x-collapse.accordion :id="esc_attr($block->block->id)">
      @foreach ($items as $item)
        <x-collapse.accordion.item
          accordion-id="{{ esc_attr($block->block->id) }}"
          :show="$loop->first && $openFirst"
        >
          {{-- Heading --}}
          <x-slot name="heading">
            {!! wp_kses($item['question'], ['strong' => [], 'em' => [], 'i' => []]) !!}
          </x-slot>

          {{-- Content --}}
          {!! wp_kses($item['answer'], $allowedTinyMceTags()) !!}
        </x-collapse.accordion.item>
      @endforeach
    </x-collapse.accordion>
  @elseif ($block->preview)
    <p>{{ __('Add some accordion items ...', 'sage') }}</p>
  @endunless

  @unless ($block->preview)
  </div>
@endunless
