<?php

declare(strict_types=1);

namespace Tests;

require_once './src/items/Sulfuras.php';

use GildedRose\Sulfuras;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class SulfurasTest extends TestCase
{
    public function testQualityCannotBeMoreThanEighty()
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 0, 85);
        $conjured = new Sulfuras($item);
        $conjured->updateQuality();
        $this->assertEquals(0, $item->sellIn);
        $this->assertEquals(80, $item->quality);
    }

    public function testQualityCannotBeNegative()
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 10, -1);
        $conjured = new Sulfuras($item);
        $conjured->updateQuality();
        $this->assertEquals(10, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }
}
