<?php

require(dirname(__FILE__) . '/lib/Shoppy.php');

// API operations
require(dirname(__FILE__) . '/lib/ApiOperations/Create.php');
require(dirname(__FILE__) . '/lib/ApiOperations/Delete.php');
require(dirname(__FILE__) . '/lib/ApiOperations/Retrieve.php');

// Shoppy Models
require(dirname(__FILE__) . '/lib/Models/ApiResource.php');
require(dirname(__FILE__) . '/lib/Models/Order.php');
require(dirname(__FILE__) . '/lib/Models/ShoppyObject.php');