@unless ($products->isEmpty())
  <x-block :block="$block">
    <div class="row text-center">
      @foreach ($products as $product)
        <div class="col">
          <div class="position-relative d-flex flex-column justify-content-between h-100">
            <div>
              {!! get_the_post_thumbnail($product->ID, 'product_previwe') !!}
              <a
                class="stretched-link"
                @style(['color: ' . get_field('color', $product->ID) . ';' => get_field('color', $product->ID)])
                href="{{ get_permalink($product) }}"
              >{!! $product->post_title !!}</a>
              @if ($extendedPreviews)
                {!! wpautop(get_field('short_description', $product->ID)) !!}
              @endif
            </div>
            @if ($extendedPreviews)
              <div class="text-center">
                <x-button :href="get_permalink($product)">
                  {!! __('Show more', 'sage') !!}
                </x-button>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  </x-block>
@else
  @preview($block)
    <p>{{ __('There are no posts', 'sage') }}</p>
  @endpreview
@endunless
