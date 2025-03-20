<article class="post">

  <header>
    @if (get_the_post_thumbnail())
      <div class="post__image">
        <a href="{{ get_permalink() }}">
          {!! get_the_post_thumbnail(null, 'thumbnail') !!}
        </a>
      </div>
    @endif

    <h2 class="post__title">
      <a href="{{ get_permalink() }}">
        {!! $title !!}
      </a>
    </h2>
  </header>

  <div class="post__summary">
    @php(the_excerpt())
  </div>

</article>
