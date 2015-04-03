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

