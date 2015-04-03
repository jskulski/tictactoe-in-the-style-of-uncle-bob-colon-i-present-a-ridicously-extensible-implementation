<?php


namespace JSK\TicTacToe;

class Move {

  public static function forX($x, $y) {
    return new Move('X', $x, $y);
  }


  /**
   * return True
   */
  public function isX()
  {
    return true;
  }
}