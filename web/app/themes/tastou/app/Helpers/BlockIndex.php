<?php

namespace App\Helpers;

class BlockIndex
{
    private int $index = 100;

    public function decrease(): void
    {
        $this->index--;
    }

    public function get(): int
    {
        return $this->index;
    }
}
