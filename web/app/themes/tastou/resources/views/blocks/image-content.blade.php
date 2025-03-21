<x-block
  class="alignwide"
  :block="$block"
  @style(['align-items: ' . $verticalAlign])
>
  <div
    @class([
        'wp-block-image-content__image position-relative',
        'h-100' => $stretchImage,
    ])
    @style(['grid-column: ' . $imageGridColumn, 'grid-row: 1'])
  >
    @if ($label && $label->isSet())
      <div class="wp-block-image-content__label">
        {!! $label->image('medium') !!}
      </div>
    @endif
    {!! $image->attributes([
            'class' => collect($imageClasses)->merge(['w-100'])->join(' '),
        ])->image('medium') !!}
  </div>
  <div
    class="wp-block-image-content__content"
    @style(['grid-column: ' . $contentGridColumn, 'grid-row: 1'])
  >
    <InnerBlocks template="{{ $block->template }}" />
  </div>
</x-block>
