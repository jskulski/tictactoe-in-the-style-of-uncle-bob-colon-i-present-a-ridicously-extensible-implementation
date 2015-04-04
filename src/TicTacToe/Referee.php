<?php


namespace JSK\TicTacToe;


class Referee {
  /**
   * @var MoveFilterer
   */
  private $moveFilterer;

  function __construct()
  {
    $this->moveFilterer = new MoveFilterer();
  }

  /**
   * @param Move $move
   * @param Move[] $moveHistory
   * @return bool
   */
  public function makeCall(Move $move, array $moveHistory)
  {
    if ($this->moveHasBeenMade($move, $moveHistory)) {
      return false;
    };

    $lastMove = $this->getLastMove($moveHistory);
    if ($this->playerOfMoveIsSameAsLastMove($move, $lastMove)) {
      return false;
    }

    return true;
  }


  /**
   * @param Move[] $moveHistory
   * @return bool
   */
  public function hasWinner(array $moveHistory)
  {
    return $this->winnerIsX($moveHistory) || $this->winnerIsO($moveHistory);
  }

  /**
   * @param Move $move
   * @param Move[] $moveHistory
   * @return bool
   */
  private function moveHasBeenMade(Move $move, array $moveHistory)
  {
    forEach($moveHistory as $priorMove) {
      if ($move->equals($priorMove)) {
        return true;
      }
    }
    return false;
  }

  /**
   * @param Move $move
   * @param Move $lastMove
   * @return bool
   */
  private function playerOfMoveIsSameAsLastMove(Move $move, Move $lastMove)
  {
    if ($move->isX() && $lastMove->isX()) {
      return true;
    }

    if ($move->isO() && $lastMove->isO()) {
      return true;
    }

    return false;
  }

  /**
   * @param Move[] $moveHistory
   * @return Move
   */
  private function getLastMove(array $moveHistory)
  {
    $last = count($moveHistory) - 1;
    if ($last >= 0)
      $lastMove = $moveHistory[$last];
    else
      $lastMove = new NullMove();
    return $lastMove;
  }

  /**
   * @param Move[] $moveHistory
   * @return bool
   */
  private function checkXHasWonTopRow($moveHistory)
  {
    $marks = 0;
    foreach ($moveHistory as $move) {
      if ($move->isX() && $move->getRow() == -1) {
        $marks++;
      }
    }
    return $marks == 3;
  }

  /**
   * @param Move[] $moveHistory
   * @return bool
   */
  private function checkOHasWonTopRow(array $moveHistory)
  {
    $marks = 0;
    foreach ($moveHistory as $move) {
      if ($move->isO() && $move->getRow() == -1) {
        $marks++;
      }
    }
    return $marks == 3;
  }

  /**
   * @param array $moveHistory
   * @return bool
   */
  public function winnerIsX(array $moveHistory)
  {
     return
       $this->checkXHasWonTopRow($moveHistory)     ||
       $this->checkXHasWonMiddleRow($moveHistory)  ||
       $this->checkXHasWonBottomRow($moveHistory)  ||
       $this->checkXHasWonLeftColumn($moveHistory) ||
       $this->checkXHasWonMiddleColumn($moveHistory);
  }

  /**
   * @param Move[] $moveHistory
   * @return bool
   */
  public function winnerIsO(array $moveHistory)
  {
    return
      $this->checkOHasWonTopRow($moveHistory) ||
      $this->checkOHasWonMiddleRow($moveHistory) ||
      $this->checkOHasWonBottomRow($moveHistory);
  }

  /**
   * @param Move[] $moveHistory
   * @return bool
   */
  private function checkOHasWonMiddleRow($moveHistory)
  {
    $marks = 0;
    foreach ($moveHistory as $move) {
      if ($move->isO() && $move->getRow() == 0) {
        $marks++;
      }
    }
    return $marks == 3;
  }

  /**
   * @param Move[] $moveHistory
   * @return bool
   */
  private function checkXHasWonMiddleRow(array $moveHistory)
  {
    return $this->moveFilterer->filter($moveHistory)->movesByX()->movesInMiddleRow()->count() == 3;
  }

  /**
   * @param Move[] $moveHistory
   * @return bool
   */
  private function checkXHasWonBottomRow(array $moveHistory)
  {
    return $this->moveFilterer->filter($moveHistory)->movesByX()->movesInBottomRow()->count() == 3;
  }

  /**
   * @param Move[] $moveHistory
   * @return bool
   */
  private function checkOHasWonBottomRow(array $moveHistory)
  {
    return $this->moveFilterer->filter($moveHistory)->movesByO()->movesInBottomRow()->count() == 3;
  }

  private function checkXHasWonLeftColumn($moveHistory)
  {
    return $this->moveFilterer->filter($moveHistory)->movesByX()->movesInLeftColumn()->count() == 3;
  }

  private function checkXHasWonMiddleColumn($moveHistory)
  {
    return $this->moveFilterer->filter($moveHistory)->movesByX()->movesInMiddleColumn()->count() == 3;
  }


}

