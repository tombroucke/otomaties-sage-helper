<x-block :block="$block">
  @unless($cards->isEmpty())
    <div class="row row-cols-1 row-cols-md-{{ $columns }} g-4">
      @foreach($cards as $card)
        <div class="col">
          <x-card class="mb-3 mb-lg-0">
            {{-- Image --}}
            @if($card->get('image')->isSet())
              @slot('image')
                {!! $card->get('image')->attributes(['class' => 'card-img-top', 'alt' => $card->get('title')])->image('medium') !!}
              @endslot
            @endif

            {{-- Header --}}
            @slot('header')
            <h3 class="mb-3">{!! esc_html($card->get('title')->default(__('Add a title', 'sage'))) !!}</h3>
            @endslot

            {{-- Content --}}
            <div>
              {!! wpautop($card->get('content')) !!}
            </div>

            {{-- Button --}}
            @if($card->get('button')->isSet())
              <a href="{{ $card->get('button')->url() }}" class="btn btn-primary stretched-link">{!! esc_html($card->get('button')->title()) !!}</a>
            @endif
          </x-card>
        </div>
      @endforeach
    </div>
  @else
    @if($block->preview)
      <p>{{ __('Add some card items ...', 'sage') }}</p>
    @else
    <!-- {{ __('Add some card items ...', 'sage') }} -->
    @endif
  @endunless
</x-block>
