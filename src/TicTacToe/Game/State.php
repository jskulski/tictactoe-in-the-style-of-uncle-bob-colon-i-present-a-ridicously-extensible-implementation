<?php


namespace JSK\TicTacToe\Game;


class State {

  /** @var  Move[] */
  private $moveHistory = array();
  /** @var  boolean */
  private $winnerIsX = true;

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
    $hasWinner = $this->winnerIsX();
    return $isBoardFull || $hasWinner;
  }

  /**
   * @param $winnerIsX boolean
   */
  public function setWinnerIsX($winnerIsX) {
    $this->winnerIsX = $winnerIsX;
  }

  /**
   * @return bool
   */
  public function winnerIsX() { return $this->winnerIsX; }

  public function winnerIsO()
  {
    return false;
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

