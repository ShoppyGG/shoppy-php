<?php

require('../vendor/autoload.php');

\Shoppy\Shoppy::setApiKey('KY56tdDqEfuyZPoTgNjcWcXBDcdLy5Wzpsws9O1Bh03Ch2IQze');
$order = \Shoppy\Models\Order::retrieve('1b104d40-1a03-11e8-b66e-e1ab622befc5');

var_dump($order);