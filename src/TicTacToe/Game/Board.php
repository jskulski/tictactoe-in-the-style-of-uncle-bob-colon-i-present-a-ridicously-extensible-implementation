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
