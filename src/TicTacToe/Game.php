<?php


namespace JSK\TicTacToe;


class Game {

  /** @var  Move */
  private $lastMove;
  /** @var  boolean */
  private $gameState_isOver = false;
  /** @var  Referee */
  private $referee;

  function __construct()
  {
    $this->referee = new Referee();
  }

  public function makeMove(Move $move)
  {
    if (!$this->isValidMove($move)) {
      throw new IllegalMoveException('This is not a valid move');
    }

    $this->lastMove = $move;
    $this->gameState_isOver = true;
  }

  public function isOver()
  {
    return $this->gameState_isOver;
  }

  public function isValidMove(Move $move)
  {
    if (!$this->lastMove)
      $this->lastMove = Move::forO(4,4);
    return $this->referee->makeCall($move, $this->lastMove);
  }


}