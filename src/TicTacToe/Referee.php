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
    $lastMove = $lastMoves[0];
    if ($move->equals($lastMove)) {
      return false;
    }

    if ($move->isX() && $lastMove->isX()) {
      return false;
    }

    return true;
  }

}

