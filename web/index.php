<?php

$path = dirname(__DIR__);
require "{$path}/vendor/autoload.php";

$kernel = (new \Aura\Project_Kernel\Factory)->newKernel(
    $path,
    'Aura\Web_Kernel\WebKernel'
);
$kernel();
