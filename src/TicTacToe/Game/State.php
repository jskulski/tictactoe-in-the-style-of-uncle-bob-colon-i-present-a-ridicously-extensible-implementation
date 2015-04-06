<?php


namespace JSK\TicTacToe\Game;


class State {

  /** @var  Move[] */
  private $moveHistory;

  public function __construct() { }

  /**
   * @return Move[]
   */
  public function getMoveHistory()
  {
    return $this->moveHistory ? $this->moveHistory : array();
  }

  public function isOver()
  {
    $isBoardFull = count($this->getMoveHistory()) == 9;
    return $isBoardFull;
  }

  /**
   * @param Move
   * @return State
   */
  public function updateState(Move $move) {
    $moveHistory = $this->getMoveHistory();
    array_push($moveHistory, $move);
    $this->moveHistory = $moveHistory;
  }
}

