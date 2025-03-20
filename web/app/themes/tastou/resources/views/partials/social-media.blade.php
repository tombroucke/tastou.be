@props([
    'align' => 'start',
])

@if ($channels->isNotEmpty())
  <ul @class([
      'social-media d-flex list-unstyled',
      'justify-content-center' => $align === 'center',
  ])>
    @foreach ($channels as $channel)
      <li>
        <a
          href="{{ $channel['link'] }}"
          target="_blank"
          aria-label="{{ $channel['label'] }}"
        >
          @svg('fab-' . $channel['icon'], ['width' => '1.2em', 'height' => '1.2em'])
        </a>
      </li>
    @endforeach
  </ul>
@endif
