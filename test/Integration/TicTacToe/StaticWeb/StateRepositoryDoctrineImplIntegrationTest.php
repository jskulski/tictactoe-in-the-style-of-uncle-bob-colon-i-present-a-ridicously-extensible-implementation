<?php


namespace JSK\TicTacToe\StaticWeb;


use Doctrine\ORM\EntityManager;
use PDO;
use JSK\TicTacToe\Game\PlayerMove;
use JSK\TicTacToe\Game\State;

class StateRepositorySQLLiteIntegrationTest extends \PHPUnit_Framework_TestCase
{
  /** @var EntityManager */
  private $entityManager;
  /** @var StateRepositoryDoctrineImpl */
  private $target;

  public function setUp()
  {
    $factory = new Factory();
    $this->entityManager = $factory->createEntityManager();
    $this->target = new StateRepositoryDoctrineImpl($this->entityManager);
  }


  public function test_can_save_and_retrieve_state_on_new_database()
  {
    $state = new State();
    $state->addMoveToMoveHistory(PlayerMove::forX(-1, -1));
    $state->addMoveToMoveHistory(PlayerMove::forO(0, 1));

    $stateId = $this->target->save($state);
    $retrievedState = $this->target->retrieveById($stateId);

    $this->assertInstanceOf(State::class, $retrievedState);
    $this->assertEquals($retrievedState, $state);
  }

  public function test_save_and_retrieval_persists_outside_object()
  {
    $state = new State();
    $state->addMoveToMoveHistory(PlayerMove::forX(-1, -1));
    $state->addMoveToMoveHistory(PlayerMove::forO(0, 1));

    $stateRepository = new StateRepositoryDoctrineImpl($this->entityManager);

    $stateId = $stateRepository->save($state);

    unset($stateRepository);
    $stateRepository = new StateRepositoryDoctrineImpl($this->entityManager);
    $retrievedState = $stateRepository->retrieveById($stateId);

    $this->assertInstanceOf(State::class, $retrievedState);
    $this->assertEquals($retrievedState, $state);
  }

}