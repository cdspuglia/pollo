<?php

$path = dirname(__DIR__);
require "{$path}/vendor/autoload.php";

use Pollo\Application\WebApplication;

$polloWeb = new WebApplication($path);
$polloWeb->run();
