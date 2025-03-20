<x-block :block="$block">
  @include('partials.social-media', ['align' => $block->block->alignText])
</x-block>
