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

  public function makeMove(Move $move)
  {
    if (!$this->isValidMove($move)) {
      throw new IllegalMoveException('This is not a valid move');
    }

    $this->state->updateState($move);
  }

  public function isOver()
  {
    return $this->state->isOver();
  }

  public function isValidMove(Move $move)
  {
    $lastMove = $this->state->getLastMoves();
    return $this->referee->makeCall($move, $lastMove);
  }


}