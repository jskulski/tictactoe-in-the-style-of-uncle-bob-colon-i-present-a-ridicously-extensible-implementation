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


  public function makeMoveWithState($move, $state)
  {
    $this->state = $state;

    if (!$this->isValidMove($move, $state)) {
      throw new IllegalMoveException('This is not a valid move');
    }

    $this->state->addMoveToMoveHistory($move);

    $moveHistory = $this->state->getMoveHistory();
    $this->state->setWinnerIsX($this->referee->winnerIsX($moveHistory));
    $this->state->setWinnerIsO($this->referee->winnerIsO($moveHistory));

    return $this->state;
  }

  public function isOver()
  {
    return $this->state->isOver();
  }

  public function isValidMove(Move $move, State $state)
  {
    /** @var Move[] $lastMoves */
    $lastMoves = $state->getMoveHistory();
    return $this->referee->makeCall($move, $lastMoves);
  }

}