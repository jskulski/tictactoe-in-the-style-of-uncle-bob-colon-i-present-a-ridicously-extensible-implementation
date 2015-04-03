<?php


namespace JSK\TicTacToe;

class PlayerMove implements Move {

  const X = 'X';
  const O = 'O';

  /** @var  int */
  private $player;
  /** @var  int */
  private $x;
  /** @var  int */
  private $y;

  /**
   * @param $player int
   * @param $x int
   * @param $y int
   */
  private function __construct($player, $x, $y) {
    $this->player = $player;
    $this->x = $x;
    $this->y = $y;
  }

  /**
   * @param $x int
   * @param $y int
   * @return PlayerMove
   */
  public static function forX($x, $y) {
    return new PlayerMove(self::X, $x, $y);
  }

  /**
   * @param $x int
   * @param $y int
   * @return PlayerMove
   */
  public static function forO($x, $y) {
    return new PlayerMove(self::O, $x, $y);
  }

  /**
   * @return bool
   */
  public function isX()
  {
    return $this->player == self::X;
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

  /**
   * @param Move $that
   * @return bool
   */
  public function equals(Move $that)
  {
    return  $this->getX() == $that->getX() && $this->getY() == $that->getY();
  }

}