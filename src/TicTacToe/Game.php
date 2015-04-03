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
    $this->lastMove = new NullMove();
  }

  public function makeMove(PlayerMove $move)
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

  public function isValidMove(PlayerMove $move)
  {
    return $this->referee->makeCall($move, $this->lastMove);
  }


}