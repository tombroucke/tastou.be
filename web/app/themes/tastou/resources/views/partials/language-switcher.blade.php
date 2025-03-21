@unless (empty($inactiveLanguages))
  <div class="text-uppercase">
    <ul class="language-switcher d-flex list-unstyled h-100 align-items-center m-0 gap-2">
      @if ($activeLanguage)
        <li>
          <span>
            {{ $activeLanguage->code }}
          </span>
        </li>
      @endif
      @foreach ($inactiveLanguages as $inactiveLanguage)
        <li>
          <a href="{{ $inactiveLanguage->url }}">
            {{ $inactiveLanguage->code }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
@endunless
