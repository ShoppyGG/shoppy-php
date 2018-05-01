<?php

namespace Shoppy\Models;

use Shoppy\ApiOperations\All;
use Shoppy\ApiOperations\Retrieve;

class Attachment extends ApiResource
{
    use Retrieve;
    use All;
}