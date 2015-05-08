<?php


namespace JSK\TicTacToe\StaticWeb;

use Doctrine\ORM\Configuration;
use PDO;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Factory {

  /** @var PDO */
  private $pdo;
  /** @var  EntityManager */
  private $entityManager;
  /** @var  StateRepository */
  private $stateRepository;
  /** @var  Connection */
  private $doctrineConnection;
  /** @var  Configuration */
  private $doctrineConfiguration;

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
      $this->entityManager = EntityManager::create($this->createDoctrineConnection($pdo), $this->createDoctrineConfig());
    }
    return $this->entityManager;
  }

  public function createDoctrineConfig()
  {
    if (!$this->doctrineConnection) {
      $this->doctrineConfiguration = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/../../../src/TicTacToe/Game"), true);
    }
    return $this->doctrineConfiguration;
  }

  public function createDoctrineConnection(PDO $pdo)
  {
    if (!$this->doctrineConnection) {
      $this->doctrineConnection = DriverManager::getConnection(array('pdo' => $pdo), $this->createDoctrineConfig());
    }
    return $this->doctrineConnection;
  }


  public function createSchemaManager(PDO $pdo)
  {
    return $this->createDoctrineConnection($pdo)->getSchemaManager();
  }

  public function createStateRepository() {
    if (!$this->stateRepository) {
      $this->stateRepository = new StateRepositoryDoctrineImpl($this->createEntityManager());
    }
    return $this->stateRepository;
  }

}