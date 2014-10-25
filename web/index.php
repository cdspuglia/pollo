<?php

$path = dirname(__DIR__);
require "{$path}/vendor/autoload.php";

/** @var Aura\Web_Kernel\WebKernel $kernel */
$kernel = (new \Aura\Project_Kernel\Factory)->newKernel(
    $path,
    'Aura\Web_Kernel\WebKernel'
);
$kernel();
