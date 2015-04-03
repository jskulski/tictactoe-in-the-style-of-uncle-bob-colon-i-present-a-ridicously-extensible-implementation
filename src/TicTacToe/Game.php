<?php


namespace JSK\TicTacToe;


class Game {

  /** @var  Referee */
  private $referee;
  /** @var  State */
  private $state;


  function __construct()
  {
    $this->state = new State();
    $this->referee = new Referee();
  }

  public function makeMove(PlayerMove $move)
  {
    if (!$this->isValidMove($move)) {
      throw new IllegalMoveException('This is not a valid move');
    }

    $this->lastMove = $move;
    $this->state->updateState($move);
  }

  public function isOver()
  {
    return $this->state->isOver();
  }

  public function isValidMove(PlayerMove $move)
  {
    $lastMove = $this->state->getLastMove();
    return $this->referee->makeCall($move, $lastMove);
  }


}