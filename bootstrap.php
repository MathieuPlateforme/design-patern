<?php
require_once 'vendor/autoload.php'; // Autoload your Composer dependencies

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true; // Set to false in production
$config = Setup::createAnnotationMetadataConfiguration([__DIR__."/src"], $isDevMode);

// Database configuration parameters
$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'solid-blog',
];

// obtaining the entity manager
$entityManager = EntityManager::create($dbParams, $config);