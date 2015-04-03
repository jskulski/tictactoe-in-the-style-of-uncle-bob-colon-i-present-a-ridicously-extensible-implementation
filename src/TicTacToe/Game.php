<?php


namespace JSK\TicTacToe;

class Game {

  /** @var  Move */
  private $lastMove;
  /** @var  boolean */
  private $gameState_isOver = false;

  public function makeMove(Move $move)
  {
    $this->lastMove = $move;
    $this->gameState_isOver = true;
  }

  public function isOver()
  {
    return $this->gameState_isOver;
  }

  public function isValidMove(Move $move)
  {
    if ($this->lastMove && $this->lastMove->isX()) {
      return false;
    }
    return true;
  }

}