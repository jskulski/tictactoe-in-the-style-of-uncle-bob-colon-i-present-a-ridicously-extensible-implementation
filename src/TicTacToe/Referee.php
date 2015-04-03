<?php


namespace JSK\TicTacToe;


class Referee {

  /**
   * @param PlayerMove $move
   * @return bool
   */
  public function makeCall(Move $move, Move $lastMove)
  {
    if ($move->equals($lastMove)) {
      return false;
    }

    if ($move->isX() && $lastMove->isX()) {
      return false;
    }

    return true;
  }

}

