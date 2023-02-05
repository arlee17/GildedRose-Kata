<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item instanceof UpdateQualityInterface) {
                $item->updateQuality();
            }
        }
    }
}
