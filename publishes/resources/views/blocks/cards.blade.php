@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @unless ($cards->isEmpty())
    <div class="row row-cols-1 row-cols-md-{{ $columns }} g-4">
      @foreach ($cards as $card)
        <div class="col">
          <x-card class="mb-lg-0 h-100 position-relative mb-3">
            {{-- Image --}}
            @if ($card['image']->isSet())
              @slot('image')
                {!! $card['image']->attributes(['class' => 'card-img-top', 'alt' => $card['title']])->image('medium') !!}
              @endslot
            @endif

            {{-- Header --}}
            @slot('header')
              <h3>{!! wp_kses($card['title']->default(__('Add a title', 'sage')), $allowedInlineTags()) !!}</h3>
            @endslot

            {{-- Content --}}
            <div>
              {!! wp_kses($card['content'], $allowedTinyMceTags()) !!}
            </div>

            {{-- Button --}}
            @if ($card['button']->isSet())
              <x-button
                class="stretched-link"
                :href="$card['button']->url()"
              >
                {!! wp_kses(html_entity_decode($card['button']->title()), $allowedInlineTags()) !!}
              </x-button>
            @endif
          </x-card>
        </div>
      @endforeach
    </div>
  @elseif ($block->preview)
    <p>{{ __('Add some card items ...', 'sage') }}</p>
  @endunless

  @unless ($block->preview)
  </div>
@endunless
