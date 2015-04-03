<?php


namespace JSK\TicTacToe;


class State {

  /** @var  Move[] */
  private $lastMoves;
  /** @var  boolean */
  private $gameState_isOver = false;

  public function __construct() {
    $this->lastMoves = array(new NullMove());
  }

  /**
   * @return Move
   */
  public function getLastMoves()
  {
    return $this->lastMoves;
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
    $this->lastMoves[0] = $move;
    $this->gameState_isOver = true;
  }
}

