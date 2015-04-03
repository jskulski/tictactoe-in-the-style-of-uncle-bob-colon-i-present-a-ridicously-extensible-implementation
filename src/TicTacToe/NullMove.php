<?php


namespace JSK\TicTacToe;


class NullMove implements Move {

  const NULL_X_MARKER = -999;
  const NULL_Y_MARKER = -999;

  /**
   * @return int
   */
  public function getX()
  {
    return self::NULL_X_MARKER;
  }

  /**
   * @return int
   */
  public function getY()
  {
    return self::NULL_Y_MARKER;
  }

  /**
   * @return bool
   */
  public function isX()
  {
    return false;
  }

}