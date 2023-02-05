<?php

declare(strict_types=1);

namespace Tests;

require_once './src/items/AgedBrie.php';

use GildedRose\AgedBrie;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class AgedBrieTest extends TestCase
{
    public function testQualityCannotBeMoreThanFifty()
    {
        $item = new Item('Aged Brie', 10, 55);
        $backstagePasses = new AgedBrie($item);
        $backstagePasses->updateQuality();
        $this->assertSame(9, $item->sellIn);
        $this->assertSame(50, $item->quality);
    }

    public function testQualityCannotBeNegative()
    {
        $item = new Item('Aged Brie', 10, -1);
        $backstagePasses = new AgedBrie($item);
        $backstagePasses->updateQuality();
        $this->assertSame(9, $item->sellIn);
        $this->assertSame(0, $item->quality);
    }

    public function testQualityIncreasesWithEachPassingDays(): void
    {
        $item = new Item('Aged Brie', 10, 10);
        $agedBrie = new AgedBrie($item);
        $agedBrie->updateQuality();
        $this->assertSame(9, $item->sellIn);
        $this->assertSame(11, $item->quality);
    }
}
