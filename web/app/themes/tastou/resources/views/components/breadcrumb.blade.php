<nav
  class="alignwide"
  aria-label="breadcrumb"
>
  <ol {{ $attributes->merge(['class' => 'breadcrumb']) }}>
    {{ $slot }}
  </ol>
</nav>
