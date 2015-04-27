<?php


namespace JSK\TicTacToe\Game;

class Board
{

  /** @var  Move[] */
  private $moveHistory;

  function __construct(array $moveHistory)
  {
    $this->moveHistory = $moveHistory;
  }

  public function topLeft()
  {
    return new NullMove();
  }

  public function topMiddle()
  {
    return new NullMove();
  }

  public function topRight()
  {
    return new NullMove();
  }

  public function middleLeft()
  {
    return new NullMove();
  }

  public function middleMiddle()
  {
    return new NullMove();
  }

  public function middleRight()
  {
    return new NullMove();
  }

  public function bottomgLeft()
  {
    return new NullMove();
  }

  public function bottomLeft()
  {
    return new NullMove();
  }

  public function bottomMiddle()
  {
    return new NullMove();
  }

  public function bottomRight()
  {
    return new NullMove();
  }

  /**
   * @param Move[] $moveHistory
   * @return array
   */
//  private function buildBoardArrayFromMoveHistory($moveHistory)
//  {
//    $boardArray = array(
//      self::EmptyMarker, self::EmptyMarker, self::EmptyMarker,
//      self::EmptyMarker, self::EmptyMarker, self::EmptyMarker,
//      self::EmptyMarker, self::EmptyMarker, self::EmptyMarker
//    );
//
//    /** @var Move $move */
//    foreach ($moveHistory as $move) {
//      if ($move->getRow() == 0 && $move->getColumn() == 0) {
//        $boardArray[4] = $this->playerXMarker;
//      } else {
//        $boardArray[0] = $this->playerXMarker;
//      }
//    }
//
//    return $boardArray;
//  }
}
