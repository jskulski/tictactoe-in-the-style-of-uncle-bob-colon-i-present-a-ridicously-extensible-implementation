<?php


namespace JSK\TicTacToe;


class MoveFilterer {

  const TOP_ROW    = -1;
  const MIDDLE_ROW =  0;
  const BOTTOM_ROW =  1;

  const LEFT_COLUMN   = -1;
  const MIDDLE_COLUMN =  0;
  const RIGHT_COLUMN  =  1;

  /** @var  Move[] */
  private $moves;

  /**
   * @param $moves Move[]
   */
  function __construct($moves = array()) {
    $this->moves = $moves;
  }

  /**
   * @param Move[] $moves
   * @return MoveFilterer
   */
  public function filter(array $moves)
  {
    return new MoveFilterer($moves);
  }

  /**
   * @return MoveFilterer
   */
  public function movesByO()
  {
    $filtered = array_filter($this->moves, function($move) { return $move->isO(); });
    return new MoveFilterer($filtered);
  }

  /**
   * @return MoveFilterer
   */
  public function movesByX()
  {
    $filtered = array_filter($this->moves, function($move) { return $move->isX(); });
    return new MoveFilterer($filtered);
  }


  /** @return MoveFilterer */
  public function movesInTopRow()    { return $this->movesInRow(self::TOP_ROW); }
  /** @return MoveFilterer */
  public function movesInMiddleRow() { return $this->movesInRow(self::MIDDLE_ROW); }
  /** @return MoveFilterer */
  public function movesInBottomRow() { return $this->movesInRow(self::BOTTOM_ROW); }

  /** @return MoveFilterer */
  public function movesInLeftColumn()   { return $this->movesInColumn(self::LEFT_COLUMN); }
  /** @return MoveFilterer */
  public function movesInMiddleColumn() { return $this->movesInColumn(self::MIDDLE_COLUMN); }
  /** @return MoveFilterer */
  public function movesInRightColumn()  { return $this->movesInColumn(self::RIGHT_COLUMN); }


  /**
   * @return int
   */
  public function count() {  return count($this->moves); }

  /**
   * @param $row int
   * @return MoveFilterer
   */
  private function movesInRow($row)
  {
    $filtered = array_filter($this->moves, function($move) use ($row) {
      return $move->getRow() == $row;
    });
    return new MoveFilterer($filtered);
  }

  /**
   * @param $column int
   * @return MoveFilterer
   */
  private function movesInColumn($column)
  {
    $filtered = array_filter($this->moves, function($move) use ($column) {
      return $move->getColumn() == $column;
    });
    return new MoveFilterer($filtered);
  }
}

