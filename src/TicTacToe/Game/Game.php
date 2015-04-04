<?php


namespace JSK\TicTacToe\Game;


class Game {

  /** @var  Referee */
  private $referee;
  /** @var  State */
  private $state;

  function __construct(Referee $referee)
  {
    $this->state = new State();
    $this->referee = $referee;
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
    /** @var Move[] $lastMoves */
    $lastMoves = $this->state->getMoveHistory();
    return $this->referee->makeCall($move, $lastMoves);
  }

}