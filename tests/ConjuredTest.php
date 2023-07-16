<?php

declare(strict_types=1);

namespace Tests;

require_once './src/items/Conjured.php';

use GildedRose\Conjured;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class ConjuredTest extends TestCase
{
    public function testQualityCannotBeMoreThanFifty()
    {
        $item = new Item('Conjured', 10, 55);
        $backstagePasses = new Conjured($item);
        $backstagePasses->updateQuality();
        $this->assertSame(9, $item->sellIn);
        $this->assertSame(50, $item->quality);
    }

    public function testQualityCannotBeNegative()
    {
        $item = new Item('Conjured', 10, -1);
        $conjured = new Conjured($item);
        $conjured->updateQuality();
        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }
    
    public function testQualityDecreasesByTwo()
    {
        $item = new Item('Conjured', 10, 20);
        $conjured = new Conjured($item);
        $conjured->updateQuality();
        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(18, $item->quality);
    }
}
