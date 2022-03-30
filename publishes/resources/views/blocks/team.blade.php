<x-block :block="$block">
	@unless($members->isEmpty())
	  @foreach($members as $member)
		<div class="row">
		  @if($member->get('image')->isSet())
			<div class="col-md-3">
			  {!! $member->get('image')->image('thumbnail') !!}
			</div>
		  @endif
		  <div class="col">
			<h3>{!! $member->get('name') !!}</h3>
			@if ($member->get('function'))
			  <h4>{!! $member->get('function') !!}</h4>
			@endif
			@if($member->get('email') || $member->get('phone'))
			  <p>
				@if($member->get('email'))
				  {!! do_shortcode('[email address="' . $member->get('email') . '"]') !!}<br/>
				@endif
				@if($member->get('phone'))
				  {!! $member->get('phone') !!}
				@endif
			  </p>
			@endif
			@if($member->get('description'))
			  {!! wpautop($member->get('description')) !!}
			@endif
		  </div>
		</div>
	  @endforeach
	@else
	  @if($block->preview)
		<p>{{ __('Add some member ...', 'sage') }}</p>
	  @else
	  <!-- {{ __('Add some member ...', 'sage') }} -->
	  @endif
	@endunless
  </x-block>
  