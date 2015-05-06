<?php


namespace JSK\TicTacToe\StaticWeb;

use Doctrine\ORM\EntityManager;
use JSK\TicTacToe\Game\State;

class StateRepositoryDoctrineImpl {

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
  public function retrieveById($id) {
    return $this->entityManager->find(State::class, $id);
  }

  /**
   * @param State $state
   * @return int
   */
  public function save(State $state)
  {
    $this->entityManager->persist($state);
    $this->entityManager->flush();
    return $state->getStateId();
  }

}