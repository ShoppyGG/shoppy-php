<?php

namespace Shoppy\Models;

use Shoppy\ApiOperations\All;
use Shoppy\ApiOperations\Create;
use Shoppy\ApiOperations\Retrieve;

class Product extends ApiResource
{
    use Retrieve;
    use Create;
    use All;
}