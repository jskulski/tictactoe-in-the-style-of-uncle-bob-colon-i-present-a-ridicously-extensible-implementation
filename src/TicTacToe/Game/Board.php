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

  /**
   * @return Move
   */
  public function topLeft()
  {
    if (count($this->moveHistory) > 0) {
      return PlayerMove::forX(-1, -1);
    }
    else {
      return new NullMove();
    }
  }

  /**
   * @return Move
   */
  public function topMiddle()
  {
    return new NullMove();
  }

  /**
   * @return Move
   */
  public function topRight()
  {
    return new NullMove();
  }

  /**
   * @return Move
   */
  public function middleLeft()
  {
    return new NullMove();
  }

  /**
   * @return Move
   */
  public function middleMiddle()
  {
    return new NullMove();
  }

  /**
   * @return Move
   */
  public function middleRight()
  {
    return new NullMove();
  }

  /**
   * @return Move
   */
  public function bottomLeft()
  {
    return new NullMove();
  }

  /**
   * @return Move
   */
  public function bottomMiddle()
  {
    return new NullMove();
  }

  /**
   * @return Move
   */
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
