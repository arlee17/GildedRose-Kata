<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/items/Item.php';
require_once __DIR__ . '/../src/items/AgedBrie.php';
require_once __DIR__ . '/../src/items/BackstagePasses.php';
require_once __DIR__ . '/../src/items/Conjured.php';
require_once __DIR__ . '/../src/items/SimpleItem.php';
require_once __DIR__ . '/../src/items/Sulfuras.php';
        
use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\AgedBrie;
use GildedRose\BackstagePasses;
use GildedRose\Conjured;
use GildedRose\SimpleItem;
use GildedRose\Sulfuras;

echo 'OMGHAI!' . PHP_EOL;

$items = [
    new SimpleItem( new Item('+5 Dexterity Vest', 10, 20)),
    new AgedBrie( new Item('Aged Brie', 2, 0)),
    new SimpleItem( new Item('Elixir of the Mongoose', 5, 7)),
    new Sulfuras( new Item('Sulfuras, Hand of Ragnaros', 0, 80)),
    new Sulfuras( new Item('Sulfuras, Hand of Ragnaros', -1, 80)),
    new BackstagePasses( new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20)),
    new BackstagePasses( new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49)),
    new BackstagePasses( new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49)),
    new Conjured( new Item('Conjured Mana Cake', 3, 6)),
];

$app = new GildedRose($items);

$days = 2;
if ((is_countable($argv) ? count($argv) : 0) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo "-------- day ${i} --------" . PHP_EOL;
    echo 'name, sellIn, quality' . PHP_EOL;
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateQuality();
}
