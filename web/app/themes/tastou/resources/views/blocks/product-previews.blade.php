@unless ($products->isEmpty())
  <x-block :block="$block">
    <div class="row gx-lg-5 justify-content-center text-center">
      @foreach ($products as $product)
        <div class="col-6 col-md-3">
          <div
            class="wp-block-product-previews__product position-relative d-flex flex-column justify-content-between h-100"
          >
            <div>
              {!! get_the_post_thumbnail($product->ID, 'product_preview') !!}
              @if (false)
                <a
                  class="stretched-link"
                  @style(['color: ' . get_field('color', $product->ID) . ';' => get_field('color', $product->ID)])
                  href="{{ get_permalink($product) }}"
                >{!! $product->post_title !!}</a>
              @else
                <h3 @style(['color: ' . get_field('color', $product->ID) . ';' => get_field('color', $product->ID)])>{!! $product->post_title !!}</h3>
              @endif
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
