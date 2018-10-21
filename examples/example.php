<?php

require('../vendor/autoload.php');

\Shoppy\Shoppy::setApiKey('KY56tdDqEfuyZPoTgNjcWcXBDcdLy5Wzpsws9O1Bh03Ch2IQze');

/**
 * Example to fetch a single ApiResource
 */

$order = \Shoppy\Models\Order::retrieve('1b104d40-1a03-11e8-b66e-e1ab622befc5');

var_dump($order->id);

/**
 * Example to iterate over all orders
 */

$orders = \Shoppy\Models\Order::all();
$pages = $orders->count();

for ($i = 1; $i < $pages; $i++) {
    $orders = \Shoppy\Models\Order::all($i);

    foreach ($orders->toArray() as $order) {
        echo $order->id . PHP_EOL;
    }
}
