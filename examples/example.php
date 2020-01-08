<?php

require('../vendor/autoload.php');

\Shoppy\Shoppy::setApiKey('6AX9cPuUZN5PzUjG0caUkdv3yYrd0GCScrBcwzgjQTOGAkAQqx');

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

/**
 * Example to create a product
 */

try {
    $product = \Shoppy\Models\Product::create([
        'title'         => 'My test product',
        'price'         => 10,
        'unlisted'      => false,
        'type'          => 'service',
        'currency'      => 'EUR',
        'stock_warning' => 0,
        'quantity'      => [
            'min' => 1,
            'max' => 10
        ],
        'email'         => [
            'enabled' => false
        ]
    ]);

} catch (\Shoppy\Errors\ValidationException $exception) {
    printf("ValidationException \r\n");

    foreach ($exception->errors as $fieldName => $description) {
        printf("${fieldName}: %s \r\n", join($description, ','));
    }

} catch (\Shoppy\Errors\RatelimitationException $exception) {
    print 'You are being rate limited';
}

/**
 * Example to update a product
 */

$product = \Shoppy\Models\Product::retrieve('8YTgmEz');

$product->update([
    'title' => 'hello world'
]);