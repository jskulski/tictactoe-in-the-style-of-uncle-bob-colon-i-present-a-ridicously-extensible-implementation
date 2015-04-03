<?php


namespace JSK\TicTacToe;


class State {

  /** @var  Move[] */
  private $moveHistory;
  /** @var  boolean */
  private $gameState_isOver = false;

  public function __construct() {
    $this->moveHistory = array(new NullMove());
  }

  /**
   * @return Move
   */
  public function getMoveHistory()
  {
    return $this->moveHistory;
  }

  public function isOver()
  {
    $isBoardFull = count($this->getMoveHistory()) == 10;
    return $isBoardFull;
  }

  /**
   * @param Move
   * @return State
   */
  public function updateState(Move $move) {
    $this->moveHistory[] = $move;
    $this->gameState_isOver = true;
  }
}

