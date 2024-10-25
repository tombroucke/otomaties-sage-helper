@if ($members->isNotEmpty())
  <x-block :block="$block">
    @foreach ($members as $member)
      <div class="row">
        @if ($member['image']->isSet())
          <div class="col-md-3">
            {!! $member['image']->image('thumbnail') !!}
          </div>
        @endif
        <div class="col">
          <h3>{!! $member['name'] !!}</h3>
          @if ($member['function'])
            <h4>{!! $member['function'] !!}</h4>
          @endif
          @if ($member['email'] || $member['phone'])
            <p>
              @if ($member['email'])
                <a href="mailto:{!! $member['email']->obfuscate() !!}">{!! $member['email']->obfuscate() !!}</a><br />
              @endif
              @if ($member['phone'])
                {!! $member['phone'] !!}
              @endif
            </p>
          @endif
          @if ($member['description'])
            {!! wpautop($member['description']) !!}
          @endif
        </div>
      </div>
    @endforeach
  </x-block>
@else
  @preview($block)
    <p>{{ __('Add some members ...', 'sage') }}</p>
  @endpreview
@endunless
