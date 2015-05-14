<?php


namespace JSK\TicTacToe\StaticWeb;


use PDO;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use JSK\TicTacToe\Game\PlayerMove;
use JSK\TicTacToe\Game\State;
use Doctrine\ORM\Mapping\ClassMetadata;


class StateRepositoryDoctrineImplTest extends \PHPUnit_Framework_TestCase
{

  /** @var StateRepositoryDoctrineImpl */
  private $target;
  /** @var EntityManager */
  private $entityManager;

  /** @var SchemaTool */
  private $schemaTool;
  /** @var ClassMetadata[] */
  private $metadata;

  public function setUp()
  {
    $factory = new Factory();
    $pdo = new PDO('sqlite::memory:');
    $this->entityManager = $factory->createEntityManagerWithPDO($pdo);

    $this->metadata = array(
      $this->entityManager->getClassMetadata(State::class),
      $this->entityManager->getClassMetadata(PlayerMove::class)
    );
    $this->metadata[0]->setPrimaryTable(array('name' => $this->metadata[0]->getTableName() . 'test'));
    $this->metadata[1]->setPrimaryTable(array('name' => $this->metadata[1]->getTableName() . 'test'));

    $this->schemaTool = new SchemaTool($this->entityManager);
    $this->schemaTool->dropSchema($this->metadata);
    $this->schemaTool->createSchema($this->metadata);

    $this->target = new StateRepositoryDoctrineImpl($this->entityManager);
  }

  public function tearDown()
  {
//    $this->schemaTool->dropSchema(array($this->metadata));
  }

  public function test_can_save_and_retrieve_state_on_new_database()
  {
    $state = new State();
    $state->addMoveToMoveHistory(PlayerMove::forX(-1, -1));
    $state->addMoveToMoveHistory(PlayerMove::forO(0, 1));

    $stateId = $this->target->save($state);
    $this->clearDoctrineCache();
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

  public function test_that_states_persisted_have_accurate_move_histories()
  {
    $state = new State();
    $moveHistory = array(
      PlayerMove::forX(-1, -1),
      PlayerMove::forO(0, 0),
      PlayerMove::forX(1, 1)
    );
    $state->setMoveHistory($moveHistory);

    $stateId = $this->target->save($state);
    $retrievedState = $this->target->retrieveById($stateId);

    $retrievedMoveHistory = $retrievedState->getMoveHistory();
    $this->assertEquals($moveHistory[0], $retrievedMoveHistory[0]);
  }



  private function clearDoctrineCache()
  {
    $this->entityManager->clear();
  }

}
