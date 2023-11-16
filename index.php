<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\AppInitializer;
use MongoDB\Client;

require 'vendor/autoload.php';

$initializer = new AppInitializer();
$initializer->run();
