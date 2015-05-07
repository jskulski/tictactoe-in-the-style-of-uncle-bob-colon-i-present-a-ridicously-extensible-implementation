<?php


namespace JSK\TicTacToe\StaticWeb;

use PDO;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Factory {

  /** @var PDO */
  private $pdo;
  /** @var  EntityManager */
  private $entityManager;

  public function createPDO()
  {
    if (!$this->pdo) {
      $this->pdo = new \PDO('sqlite:/Users/jskulski/tmp/tictactoe/db.sqlite');
    }
    return $this->pdo;
  }

  public function createEntityManager() {
    return $this->createEntityManagerWithPDO($this->createPDO());
  }

  public function createEntityManagerWithPDO(PDO $pdo)
  {
    if (!$this->entityManager) {
      $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../../../src/TicTacToe/Game"), true);
      $connection = DriverManager::getConnection(array('pdo' => $pdo), $config);
      $this->entityManager = EntityManager::create($connection, $config);
    }
    return $this->entityManager;
  }

}