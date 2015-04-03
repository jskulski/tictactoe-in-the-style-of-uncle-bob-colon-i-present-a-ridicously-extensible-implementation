<?php


namespace JSK\TicTacToe;

class State {

  /** @var  Move */
  private $lastMove;
  /** @var  boolean */
  private $gameState_isOver = false;

  public function __construct() {
    $this->lastMove = new NullMove();
  }

  /**
   * @return Move
   */
  public function getLastMove()
  {
    return $this->lastMove;
  }

  public function isOver()
  {
    return $this->gameState_isOver;
  }


  /**
   * @param Move
   * @return State
   */
  public function updateState(Move $move) {
    $this->lastMove = $move;
    $this->gameState_isOver = true;
  }
}


class Game {

  /** @var  Referee */
  private $referee;
  /** @var  State */
  private $state;


  function __construct()
  {
    $this->state = new State();
    $this->referee = new Referee();
  }

  public function makeMove(PlayerMove $move)
  {
    if (!$this->isValidMove($move)) {
      throw new IllegalMoveException('This is not a valid move');
    }

    $this->lastMove = $move;
    $this->state->updateState($move);
  }

  public function isOver()
  {
    return $this->state->isOver();
  }

  public function isValidMove(PlayerMove $move)
  {
    $lastMove = $this->state->getLastMove();
    return $this->referee->makeCall($move, $lastMove);
  }


}