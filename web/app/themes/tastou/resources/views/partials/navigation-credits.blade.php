<div class="d-flex justify-content-center">
  <nav class="navigation-credits">
    <ul class="d-flex list-unstyled m-0 flex-wrap gap-3">

      @if ($navigation)
        @foreach ($navigation as $item)
          <li @class([
              'menu-item',
              'menu-item--active' => $item->active,
              'menu-item--has-submenu' => $item->children,
          ])>
            @if (isset($item->buttonTheme))
              <x-button
                :href="$item->url"
                :theme="$item->buttonTheme"
                :target="$item->target"
              >
                {!! $item->label !!}
              </x-button>
            @else
              <a
                href="{{ $item->url }}"
                target="{{ $item->target }}"
              >
                {!! $item->label !!}
              </a>
            @endif

            @if ($item->children)
              @include('partials.navigation-children', ['children' => $item->children])
            @endif
          </li>
        @endforeach
      @endif

      <li class="menu-item">
        &copy;@year {{ $siteName }}
      </li>

    </ul>
  </nav>
</div>
