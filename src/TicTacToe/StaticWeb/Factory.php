<?php


namespace JSK\TicTacToe\StaticWeb;

use PDO;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Factory {

  public function createEntityManager()
  {
    $pdo = new \PDO('sqlite:/Users/jskulski/tmp/tictactoe/db.sqlite');
    $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../../../src/TicTacToe/Game"), true);
    $connection = DriverManager::getConnection(array('pdo' => $pdo), $config);
    return EntityManager::create($connection, $config);
  }

}