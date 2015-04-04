<?php


namespace JSK\TicTacToe;


interface Move {

  /**
   * @return int
   */
  public function getRow();

  /**
   * @return int
   */
  public function getColumn();

  /**
   * @return bool
   */
  public function isX();
  /**
   * @return bool
   */
  public function isO();

  /** @return bool */
  public function isNullObject();

  /** @return bool */
  public function equals(Move $move);

}
