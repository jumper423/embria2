<?php

require_once __DIR__ . "/../vendor/autoload.php";

$db = \jumper423\DataBase::connect('embria2', 'homestead', 'secret', 'localhost', 33060);
$countingDomains = new \jumper423\CountingDomains($db);
$hosts = $countingDomains->get();
print_r($hosts);