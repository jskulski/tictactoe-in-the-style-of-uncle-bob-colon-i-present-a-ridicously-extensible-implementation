<?php


namespace JSK\TicTacToe;


class Referee {

  /**
   * @param Move $move
   * @param Move[] $moveHistory
   * @return bool
   */
  public function makeCall(Move $move, array $moveHistory)
  {
    if ($this->moveHasBeenMade($move, $moveHistory)) {
      return false;
    };

    $lastMove = $this->getLastMove($moveHistory);
    if ($this->playerOfMoveIsSameAsLastMove($move, $lastMove)) {
      return false;
    }

    return true;
  }

  /**
   * @param Move $move
   * @param Move[] $moveHistory
   * @return bool
   */
  private function moveHasBeenMade(Move $move, array $moveHistory)
  {
    forEach($moveHistory as $priorMove) {
      if ($move->equals($priorMove)) {
        return true;
      }
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

  /**
   * @param Move[] $moveHistory
   * @return Move
   */
  private function getLastMove(array $moveHistory)
  {
    $last = count($moveHistory) - 1;
    return $moveHistory[$last];
  }

}

