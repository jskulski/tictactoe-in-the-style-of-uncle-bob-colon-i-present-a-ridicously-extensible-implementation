<?php


namespace JSK\TicTacToe;


class Referee {

  /**
   * @param Move $move
   * @return bool
   */
  public function makeCall(Move $move, Move $lastMove)
  {
    if ($lastMove && $move->getX() == $lastMove->getX() && $move->getY() == $lastMove->getY()) {
      return false;
    }

    if ($move->isX() && $lastMove && $lastMove->isX()) {
      return false;
    }
    return true;
  }

}

