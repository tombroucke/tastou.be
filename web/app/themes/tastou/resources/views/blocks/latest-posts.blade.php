@if ($latestPosts->have_posts())
  <x-block
    id="wp-block-latest-posts"
    :block="$block"
  >
    <div class="row justify-content-center">
      @while ($latestPosts->have_posts())
        @php($latestPosts->the_post())
        <div class="col-md-{{ 12 / $postsPerPage->toInt() }}">
          @includeFirst(['partials.content-' . $postType, 'partials.content'])
        </div>
      @endwhile
    </div>

    <div class="text-center">
      <x-button
        href="{{ $archiveLink }}"
        theme="blue"
      >
        {!! $archiveButtonLabel !!}
      </x-button>
    </div>

    @includeWhen($showPagination, 'partials.pagination', [
        'wpQuery' => $latestPosts,
        'addFragment' => '#wp-block-latest-posts',
    ])
  </x-block>
@else
  @preview($block)
    <p>{{ __('There are no posts', 'sage') }}</p>
  @endpreview
@endif
