<x-block :block="$block">
  @unless($cards->isEmpty())
    <div class="card-deck d-block d-lg-flex justify-content-center">
      @foreach($cards as $card)
        <x-card class="mb-3 mb-lg-0">
          {{-- Image --}}
          @slot('image')
            @if($card->get('image')->isSet())
              {!! $card->get('image')->attributes(['class' => 'card-img-top', 'alt' => $card->get('title')])->image('medium') !!}
            @endif
          @endslot

          {{-- Content --}}
          <h3 class="mb-3">{!! $card->get('title')->default(__('Add a title', 'sage')) !!}</h3>
          <div>
            {!! wpautop($card->get('content')) !!}
          </div>

          {{-- Button --}}
          @if($card->get('button')->isSet())
            <a href="{{ $card->get('button')->url() }}" class="btn btn-primary stretched-link">{!! $card->get('button')->title() !!}</a>
          @endif
        </x-card>
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
