<?php


namespace JSK\TicTacToe;


class Game {

  /** @var  boolean */
  private $gameState_isOver = false;


  public function makeMove()
  {
    $this->gameState_isOver = true;
  }

  public function isOver()
  {
    return $this->gameState_isOver;
  }

  public function isValidMove(Move $move)
  {
  }

}