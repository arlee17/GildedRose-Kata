<?php

declare(strict_types=1);

namespace GildedRose;

require_once  __DIR__ . '/../interfaces/UpdateQualityInterface.php';

use GildedRose\UpdateQualityInterface;

class BackstagePasses implements UpdateQualityInterface
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function updateQuality(): void
    {
        $qualityIncrement = 1;
        $maxQuality = 50;
        $minQuality = 0;
        $this->item->sellIn--;
        if ($this->item->sellIn < 11) {
            $qualityIncrement++;
        }
        if ($this->item->sellIn < 6) {
            $qualityIncrement++;
        }
        $this->item->quality = min($maxQuality, $this->item->quality + $qualityIncrement);
        $this->item->quality = $this->item->sellIn < 0 ? $minQuality : $this->item->quality;
    }

    public function __toString(): string
    {
        return "{$this->item->name}, {$this->item->sellIn}, {$this->item->quality}";
    }
}
