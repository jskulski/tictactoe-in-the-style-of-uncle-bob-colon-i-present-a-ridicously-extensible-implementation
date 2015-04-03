<?php


namespace JSK\TicTacToe;

class Move {

  /** @var  string */
  private $player;
  /** @var  int */
  private $x;
  /** @var  int */
  private $y;

  private function __construct($player, $x, $y) {
    $this->player = $player;
    $this->x = $x;
    $this->y = $y;
  }

  public static function forX($x, $y) {
    return new Move('X', $x, $y);
  }

  public static function forO($x, $y) {
    return new Move('O', $x, $y);
  }

  /**
   * @return bool
   */
  public function isX()
  {
    return $this->player == 'X';
  }

  /**
   * @return int
   */
  public function getX()
  {
    return $this->x;
  }

  /**
   * @return int
   */
  public function getY()
  {
    return $this->y;
  }

}