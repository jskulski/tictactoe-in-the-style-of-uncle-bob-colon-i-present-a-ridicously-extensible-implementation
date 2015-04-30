<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\State;


class StateRepositorySQLLite {

  /** @var  */
  private $state;

  public function save(State $state)
  {
    $this->state = $state;
    return 1;
  }

  public function retrieveById($stateId)
  {
    return $this->state;
  }
}