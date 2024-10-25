<x-block :block="$block">
  @unless ($cards->isEmpty())
    <div class="row row-cols-1 row-cols-md-{{ $columns }} g-4">
      @foreach ($cards as $card)
        <div class="col">
          <x-card class="mb-3 mb-lg-0 h-100">
            {{-- Image --}}
            @if ($card['image']->isSet())
              @slot('image')
                {!! $card['image']->attributes(['class' => 'card-img-top', 'alt' => $card['title']])->image('medium') !!}
              @endslot
            @endif

            {{-- Header --}}
            @slot('header')
              <h3>{!! esc_html($card['title']->default(__('Add a title', 'sage'))) !!}</h3>
            @endslot

            {{-- Content --}}
            <div>
              {!! wpautop($card['content']) !!}
            </div>

            {{-- Button --}}
            @if ($card['button']->isSet())
              <x-button
                class="stretched-link"
                :href="$card['button']->url()"
              >
                {!! esc_html($card['button']->title()) !!}
              </x-button>
            @endif
          </x-card>
        </div>
      @endforeach
    </div>
  @else
    @if ($block->preview)
      <p>{{ __('Add some card items ...', 'sage') }}</p>
    @else
      <!-- {{ __('Add some card items ...', 'sage') }} -->
    @endif
  @endunless
</x-block>
