<?php

require_once __DIR__ . '/vendor/autoload.php';

$factory = new \JSK\TicTacToe\StaticWeb\Factory();
$entityManager = $factory->createEntityManager();
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
