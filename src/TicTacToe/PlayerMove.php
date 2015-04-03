<?php


namespace JSK\TicTacToe;

class PlayerMove implements Move {

  const X = 'X';
  const O = 'O';

  /** @var  int */
  private $player;
  /** @var  int */
  private $row;
  /** @var  int */
  private $column;

  /**
   * @param $player int
   * @param $row int
   * @param $column int
   */
  private function __construct($player, $row, $column) {
    $this->player = $player;
    $this->row = $row;
    $this->column = $column;
  }

  /**
   * @param $row int
   * @param $column int
   * @return PlayerMove
   */
  public static function forX($row, $column) {
    return new PlayerMove(self::X, $row, $column);
  }

  /**
   * @param $row int
   * @param $column int
   * @return PlayerMove
   */
  public static function forO($row, $column) {
    return new PlayerMove(self::O, $row, $column);
  }

  /**
   * @return bool
   */
  public function isX()
  {
    return $this->player == self::X;
  }

  /**
   * @return bool
   */
  public function isO()
  {
    return $this->player == self::O;
  }

  /**
   * @return int
   */
  public function getRow()
  {
    return $this->row;
  }

  /**
   * @return int
   */
  public function getColumn()
  {
    return $this->column;
  }

  /**
   * @param Move $that
   * @return bool
   */
  public function equals(Move $that)
  {
    return  $this->getRow() == $that->getRow() && $this->getColumn() == $that->getColumn();
  }

  /**
   * @return bool
   */
  public function isNullObject()
  {
    return false;
  }
}