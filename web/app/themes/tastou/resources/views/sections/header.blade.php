<header class="banner bg-light">

  <div class="banner__primary spacing-outer">
    <div class="container--wide container">
      <div class="d-flex justify-content-between align-items-lg-center w-100 flex-wrap">
        <a
          class="brand fw-bold text-decoration-none"
          href="{{ home_url('/') }}"
          aria-label="{{ __('Home', 'sage') }}"
        >
          @svg('logo', ['height' => '4.5em'])
        </a>
        @includeWhen(has_nav_menu('primary_navigation'), 'partials.navigation-primary')
      </div>
    </div>
  </div>

</header>
