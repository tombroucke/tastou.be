<li
  class="page-item{{ $attributes->get('class') ? ' ' . $attributes->get('class') : '' }}{{ $attributes->get('active') ? ' active' : '' }}"
><a
    class="page-link"
    href="{{ $href }}"
  >{{ $slot }}</a></li>
