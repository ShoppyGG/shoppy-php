<?php

namespace Shoppy\Models;

use Shoppy\ApiOperations\All;
use Shoppy\ApiOperations\Retrieve;

class Query extends ApiResource
{
    use Retrieve;
    use All;

    public function reply($message) {
        $response = $this->_httpClient->request('put', $this->instanceUrl([], 'reply'), [
            'message' => $message
        ]);

        $this->apiResponse = $response;

        return $this;
    }
}