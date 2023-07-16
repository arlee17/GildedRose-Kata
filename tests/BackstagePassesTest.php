<?php

declare(strict_types=1);

namespace Tests;

require_once './src/items/BackstagePasses.php';

use GildedRose\BackstagePasses;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class BackstagePassesTest extends TestCase
{
    public function testQualityCannotBeMoreThanFifty()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 55);
        $backstagePasses = new BackstagePasses($item);
        $backstagePasses->updateQuality();
        $this->assertSame(9, $item->sellIn);
        $this->assertSame(50, $item->quality);
    }

    public function testQualityIncrementWithEachPassingDays(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20);
        $backstagePasses = new BackstagePasses($item);
        $backstagePasses->updateQuality();
        $this->assertEquals(14, $item->sellIn);
        $this->assertEquals(21, $item->quality);
    }

    public function testQualityIncreasesByTwoFromTenDays(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10);
        $backstagePasses = new BackstagePasses($item);
        $backstagePasses->updateQuality();
        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(12, $item->quality);
    }

    public function testQualityIncreasesByThreeFromFiveDays(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10);
        $backstagePasses = new BackstagePasses($item);
        $backstagePasses->updateQuality();
        $this->assertEquals(4, $item->sellIn);
        $this->assertEquals(13, $item->quality);
    }

    public function testQualityDecrementToZeroAfterSellin(): void
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10);
        $backstagePasses = new BackstagePasses($item);
        $backstagePasses->updateQuality();
        $this->assertEquals(-1, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }
}
