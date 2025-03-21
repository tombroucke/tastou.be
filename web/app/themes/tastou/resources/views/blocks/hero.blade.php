<x-block
  @class(['d-flex', $verticalAlignClass])
  :block="$block"
>
  <div class="wp-block-hero__background">
    {!! $backgroundImage !!}
  </div>
  <div class="container--wide container">
    <div class="spacing-outer">
      <InnerBlocks />
    </div>
  </div>
</x-block>
