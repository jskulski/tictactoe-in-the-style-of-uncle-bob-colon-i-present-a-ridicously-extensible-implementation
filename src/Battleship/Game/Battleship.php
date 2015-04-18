<?php


namespace JSK\Battleship\Game;


class Battleship {

  /** @var  boolean */
  private $isSunk = false;


  /**
   * @return boolean
   */
  public function isSunk()
  {
    return $this->isSunk;
  }

  /**
   * @param boolean $isSunk
   */
  public function setIsSunk($isSunk)
  {
    $this->isSunk = $isSunk;
  }

}