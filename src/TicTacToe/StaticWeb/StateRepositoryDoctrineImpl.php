<?php


namespace JSK\TicTacToe\StaticWeb;

use Doctrine\ORM\EntityManager;
use JSK\TicTacToe\Game\PlayerMove;
use JSK\TicTacToe\Game\State;

class StateRepositoryDoctrineImpl
{

  /** @var  EntityManager */
  private $entityManager;

  function __construct(EntityManager $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  /**
   * @param int $id
   * @return State
   */
  public function retrieveById($id)
  {
    /** @var array $moveHistory */
    $moveHistory = $this->entityManager->getRepository(PlayerMove::class)->findBy(array('stateId' => $id));

    /** @var State $state */
    $state = $this->entityManager->find(State::class, $id);
    if (!$state) {
      throw new \Exception("No game state with that id found");
    }

    $state->setMoveHistory($moveHistory);
    return $state;
  }

  /**
   * @return null|object
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   * @throws \Doctrine\ORM\TransactionRequiredException
   */
  public function retrieveAll()
  {
    return $this->entityManager->getRepository(State::class)->findAll();
  }

  /**
   * @param State $state
   * @return int
   */
  public function save(State $state)
  {
    $this->entityManager->persist($state);
    $this->entityManager->flush();
    $stateId = $state->getStateId();

    $moveHistory = $state->getMoveHistory();
    foreach ($moveHistory as $move) {
      /** @var PlayerMove $move */
      $move->setStateId($stateId);
      $this->entityManager->persist($move);
      $this->entityManager->flush();
    }

    return $stateId;
  }

}