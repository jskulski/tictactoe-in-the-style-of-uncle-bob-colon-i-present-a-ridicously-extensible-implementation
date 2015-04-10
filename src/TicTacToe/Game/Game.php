<?php


namespace JSK\TicTacToe\Game;


class Game {

  /** @var  Referee */
  private $referee;

  function __construct(Referee $referee)
  {
    $this->referee = $referee;
  }

  public function makeMove(Move $move, State $state)
  {
    if (!$this->isValidMove($move, $state)) {
      throw new IllegalMoveException('This is not a valid move');
    }

    $state = $this->createNewState($move, $state);

    return $state;
  }

  public function isValidMove(Move $move, State $state)
  {
    /** @var Move[] $lastMoves */
    $lastMoves = $state->getMoveHistory();
    return $this->referee->makeCall($move, $lastMoves);
  }

  /**
   * @param Move $move
   * @param State $state
   */
  private function createNewState(Move $move, State $state)
  {
    $state->addMoveToMoveHistory($move);

    $moveHistory = $state->getMoveHistory();
    $state->setWinnerIsX($this->referee->winnerIsX($moveHistory));
    $state->setWinnerIsO($this->referee->winnerIsO($moveHistory));
    $state->setTiedGame($this->referee->isTied($moveHistory));
    $state->setPlayerXTurn($this->referee->isPlayerXTurn($moveHistory));

    return $state;
  }

}