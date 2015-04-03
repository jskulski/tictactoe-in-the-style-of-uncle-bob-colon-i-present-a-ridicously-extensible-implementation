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

}
