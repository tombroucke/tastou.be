@unless($schedule->isEmpty())
<table class="table">
	<tbody>
		@foreach($schedule as $day)
		<tr>
			<th>{{ ucfirst($day['day']) }}</th>
			<td>
				@unless(count($day['hours']) === 0)
					@foreach($day['hours'] as $hour)
						@if(is_array($hour))
							{!! implode(' - ', array_filter(Arr::flatten($hour))) !!}
						@endif
						@unless($loop->last)
							<br>
						@endunless
					@endforeach
				@else
					{{ __('Closed', 'tastou') }}
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endunless
