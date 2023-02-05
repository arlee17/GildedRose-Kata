<?php

declare(strict_types=1);

namespace GildedRose;

require_once  __DIR__ . '/../interfaces/UpdateQualityInterface.php';

use GildedRose\UpdateQualityInterface;

class AgedBrie implements UpdateQualityInterface
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateQuality(): void
    {
        $maxQuality = 50;
        $this->item->sellIn--;
        $this->item->quality = $this->item->quality > $maxQuality ? $maxQuality : $this->item->quality;
        if ($this->item->quality < $maxQuality) {
            $this->item->quality++;
        }
        if ($this->item->sellIn < 0 && $this->item->quality < $maxQuality) {
            $this->item->quality++;
        }
    }

    public function __toString(): string
    {
        return "{$this->item->name}, {$this->item->sellIn}, {$this->item->quality}";
    }
}
