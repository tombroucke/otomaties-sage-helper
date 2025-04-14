@unless ($block->preview)
  <div {{ $attributes }}>
  @endunless

  @if ($members->isNotEmpty())
    <div class="row">
      @foreach ($members as $member)
        <div class="col-md-4">
          @if ($member['image']->isSet())
            <div class="mb-3">
              {!! $member['image']->attributes(['class' => 'w-100'])->image('thumbnail') !!}
            </div>
          @endif

          <div>
            <h3>{!! wp_kses($member['name'], $allowedInlineTags()) !!}</h3>

            @if ($member['function'])
              <h4>{!! wp_kses($member['function'], $allowedInlineTags()) !!}</h4>
            @endif

            @if ($member['email'] || $member['phone'])
              <p>
                @if ($member['email'])
                  <a href="{!! esc_url('mailto:' . $member['email']->obfuscate()) !!}">{!! esc_html($member['email']->obfuscate()) !!}</a><br />
                @endif

                @if ($member['phone'])
                  {!! wp_kses($member['phone'], $allowedInlineTags()) !!}
                @endif
              </p>
            @endif

            @if ($member['description'])
              {!! wpautop(wp_kses($member['description'], $allowedInlineTags())) !!}
            @endif
          </div>

        </div>
      @endforeach
    </div>
  @elseif ($block->preview)
    <p>{{ __('Add some members ...', 'sage') }}</p>
  @endif

  @unless ($block->preview)
  </div>
@endunless
