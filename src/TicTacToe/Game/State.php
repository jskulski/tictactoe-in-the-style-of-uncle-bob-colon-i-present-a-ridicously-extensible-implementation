<?php


namespace JSK\TicTacToe\Game;


class State {

  /** @var  Move[] */
  private $moveHistory = array();
  /** @var  boolean */
  private $winnerIsX = true;
  /** @var  boolean */
  private $winnerIsO = true;

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
    $hasWinner = $this->winnerIsX() || $this->winnerIsO();
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
  public function winnerIsX() {
    return $this->winnerIsX;
  }

  /**
   * @param $winnerIsO boolean
   */
  public function setWinnerIsO($winnerIsO) {
    $this->winnerIsO = $winnerIsO;
  }

  /**
   * @return bool
   */
  public function winnerIsO()
  {
    return $this->winnerIsO;
  }

  /**
   * @param Move
   * @return State
   */
  public function addMoveToMoveHistory(Move $move) {
    $moveHistory = $this->getMoveHistory();
    array_push($moveHistory, $move);
    $this->moveHistory = $moveHistory;
  }
}

