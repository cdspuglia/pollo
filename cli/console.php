<?php

$path = dirname(__DIR__);
require "{$path}/vendor/autoload.php";

use Pollo\Application\ConsoleApplication;

$polloConsole = new ConsoleApplication($path);
$polloConsole->run();
$status = $polloConsole->getExitStatus();

exit($status);