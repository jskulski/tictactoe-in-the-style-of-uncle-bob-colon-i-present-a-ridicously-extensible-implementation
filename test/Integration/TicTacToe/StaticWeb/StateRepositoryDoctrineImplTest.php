<?php


namespace JSK\TicTacToe\StaticWeb;


use PDO;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use JSK\TicTacToe\Game\PlayerMove;
use JSK\TicTacToe\Game\State;


class StateRepositoryDoctrineImplTest extends \PHPUnit_Framework_TestCase {
  /** @var EntityManager */
  private $entityManager;
  /** @var StateRepositoryDoctrineImpl */
  private $target;

  public function setUp()
  {
    $factory = new Factory();
    $pdo = new PDO('sqlite::memory:');
    $this->entityManager = $factory->createEntityManagerWithPDO($pdo);
    $this->createEntityTables();
    $this->target = new StateRepositoryDoctrineImpl($this->entityManager);
  }


  public function test_can_save_and_retrieve_state_on_new_database()
  {
    $state = new State();
    $state->addMoveToMoveHistory(PlayerMove::forX(-1, -1));
    $state->addMoveToMoveHistory(PlayerMove::forO(0, 1));

    $stateId = $this->target->save($state);
    $retrievedState = $this->target->retrieveById($stateId);

    $this->assertEquals(1, $stateId);
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

  public function test_that_two_saves_increment_the_id()
  {
    $firstState = new State();
    $secondState = new State();

    $this->target->save($firstState);
    $this->target->save($secondState);

    $this->assertEquals(1, $firstState->getStateId());
    $this->assertEquals(2, $secondState->getStateId());
  }

  public function test_that_we_can_retrieve_all_games()
  {
    $firstState = new State();
    $secondState = new State();
    $thirdState = new State();

    $this->target->save($firstState);
    $this->target->save($secondState);
    $this->target->save($thirdState);

    $arrayOfStates = $this->target->retrieveAll();

    $this->assertEquals($firstState, $arrayOfStates[0]);
    $this->assertEquals($secondState, $arrayOfStates[1]);
    $this->assertEquals($thirdState, $arrayOfStates[2]);
  }

  private function createEntityTables()
  {
    $metadata = $this->entityManager->getClassMetadata(State::class);
    $metadata->setPrimaryTable(array('name' => $metadata->getTableName() . 'test'));
    $schemaTool = new SchemaTool($this->entityManager);
    $schemaTool->createSchema(array($metadata));
  }


}
