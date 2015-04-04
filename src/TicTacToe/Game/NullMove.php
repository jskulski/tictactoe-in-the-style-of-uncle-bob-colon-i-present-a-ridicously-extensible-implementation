<?php


namespace JSK\TicTacToe\Game;


class NullMove implements Move {

  const NULL_ROW_MARKER = -999;
  const NULL_COLUMN_MARKER = -999;

  /**
   * @return int
   */
  public function getRow()
  {
    return self::NULL_ROW_MARKER;
  }

  /**
   * @return int
   */
  public function getColumn()
  {
    return self::NULL_COLUMN_MARKER;
  }

  /**
   * @return bool
   */
  public function isX()
  {
    return false;
  }

  /**
   * @return bool
   */
  public function isO()
  {
    return false;
  }

  /**
   * @param Move $that
   * @return bool
   */
  public function equals(Move $that)
  {
    return $that->isNullObject();
  }

  /**
   * @return bool
   */
  public function isNullObject()
  {
    return true;
  }
}