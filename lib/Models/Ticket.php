<?php

namespace Shoppy\Models;

use Shoppy\ApiOperations\All;
use Shoppy\ApiOperations\Retrieve;

class Ticket extends ApiResource
{
    use Retrieve;
    use All;
}