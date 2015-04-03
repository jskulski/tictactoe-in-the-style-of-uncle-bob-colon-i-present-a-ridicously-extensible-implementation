<?php


namespace JSK\TicTacToe;


interface Move {

  /**
   * @return int
   */
  public function getX();

  /**
   * @return int
   */
  public function getY();

  /**
   * @return bool
   */
  public function isX();
  /**
   * @return bool
   */
  public function isO();

  /**
   * @return bool
   */
  public function isNullObject();

}
