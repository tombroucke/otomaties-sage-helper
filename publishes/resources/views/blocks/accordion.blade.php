@if(!$items->empty())
<x-block :block="$block">
  <x-collapse.accordion id="{{ $block->block->id }}">
    @foreach($items as $item)
      <x-collapse.accordion.item accordion-id="{{ $block->block->id }}" :show="$loop->first">
        <x-slot name="heading">
          {!! $item->get('question') !!}
        </x-slot>
        {!! $item->get('answer') !!}
      </x-collapse.accordion.item>
    @endforeach
  </x-collapse.accordion>
</x-block>
@else
  @if($block->preview)
    <p>{{ __('Add some accordion items ...', 'sage') }}</p>
  @else
  <!-- {{ __('Add some accordion items ...', 'sage') }} -->
  @endif
@endif
