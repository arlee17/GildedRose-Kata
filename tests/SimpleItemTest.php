<?php

declare(strict_types=1);

namespace Tests;

require_once './src/items/SimpleItem.php';

use GildedRose\SimpleItem;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class SimpleItemTest extends TestCase
{
    public function testQualityCannotBeMoreThanFifty()
    {
        $item = new Item('+5 Dexterity Vest', 2, 55);
        $normalItem = new SimpleItem($item);
        $normalItem->updateQuality();
        $this->assertEquals(1, $item->sellIn);
        $this->assertEquals(50, $item->quality);
    }

    public function testQualityCannotBeNegative()
    {
        $item = new Item('Conjured', 10, -1);
        $conjured = new SimpleItem($item);
        $conjured->updateQuality();
        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }

    public function testUpdateQuality()
    {
        $item = new Item('Conjured', 10, 20);
        $conjured = new SimpleItem($item);
        $conjured->updateQuality();
        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(19, $item->quality);
    }
}
