<?php


namespace JSK\TicTacToe;


class Referee {

  /**
   * @param Move $move
   * @param Move[] $lastMoves
   * @return bool
   */
  public function makeCall(Move $move, array $lastMoves)
  {
    if ($this->moveHasBeenMade($move, $lastMoves)) {
      return false;
    };

    $lastMove = $lastMoves[0];
    if ($this->playerOfMoveIsSameAsLastMove($move, $lastMove)) {
      return false;
    }

    return true;
  }

  /**
   * @param Move $move
   * @param Move[] $lastMoves
   * @return bool
   */
  private function moveHasBeenMade(Move $move, array $lastMoves)
  {
    $lastMove = $lastMoves[0];
    if ($move->equals($lastMove)) {
      return true;
    }
    return false;
  }

  /**
   * @param Move $move
   * @param Move $lastMove
   * @return bool
   */
  private function playerOfMoveIsSameAsLastMove(Move $move, Move $lastMove)
  {
    if ($move->isX() && $lastMove->isX()) {
      return true;
    }

    if ($move->isO() && $lastMove->isO()) {
      return true;
    }

    return false;
  }

}

