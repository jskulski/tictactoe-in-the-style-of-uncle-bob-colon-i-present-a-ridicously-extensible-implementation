<?php


namespace JSK\TicTacToe\Game;


class State {

  /** @var  Move[] */
  private $moveHistory = array();
  /** @var  boolean */
  private $winnerIsX = true;
  /** @var  boolean */
  private $winnerIsO = true;
  /** @var  boolean */
  private $tiedGame = false;
  /** @var  boolean */
  private $isPlayerXTurn = true;


  public function __construct() { }

  /**
   * @return Move[]
   */
  public function getMoveHistory()
  {
    return $this->moveHistory ? $this->moveHistory : array();
  }

  /**
   * @param boolean $playerXTurn
   */
  public function setPlayerXTurn($playerXTurn)
  {
    $this->isPlayerXTurn = $playerXTurn;
  }

  public function isPlayerXTurn()
  {
    return $this->isPlayerXTurn;
  }

  public function isPlayerOTurn()
  {
    return !$this->isPlayerXTurn();
  }

  /**
   * @return bool
   */
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
   * @return boolean
   */
  public function isTiedGame()
  {
    return $this->tiedGame;
  }

  /**
   * @param boolean $tiedGame
   */
  public function setTiedGame($tiedGame)
  {
    $this->tiedGame = $tiedGame;
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

