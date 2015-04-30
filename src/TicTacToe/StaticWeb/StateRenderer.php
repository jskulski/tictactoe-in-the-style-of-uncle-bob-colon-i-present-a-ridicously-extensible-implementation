<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\Move;
use JSK\TicTacToe\Game\MoveFilterer;
use League\Plates\Engine;

class StateRenderer {

  /** @var  Engine */
  private $template;
  /** @var MoveFilterer */
  private $moveFilterer;

  function __construct(Engine $template, MoveFilterer $moveFilterer)
  {
    $this->template = $template;
    $this->moveFilterer = $moveFilterer;
  }

  public function renderMove(Move $move)
  {
    if ($move->isX()) {
      return $this->template->render('X');
    }
    else if ($move->isO()) {
      return $this->template->render('O');
    }
    else if ($move->isNullObject()) {
      return $this->template->render('emptySpace');
    }
    else {
      throw new \LogicException();
    }
  }

  /**
   * @param Move[] $moveHistory
   */
  public function renderBoard(array $moveHistory)
  {
    return $this->template->render('board', array(
      'topLeft' => $this->moveFilterer->filter($moveHistory)->moveInTopLeft(),
      'topMiddle' => $this->moveFilterer->filter($moveHistory)->moveInTopMiddle(),
      'topRight' => $this->moveFilterer->filter($moveHistory)->moveInTopRight(),

      'middleLeft' => $this->moveFilterer->filter($moveHistory)->moveInMiddleLeft(),
      'middleMiddle' => $this->moveFilterer->filter($moveHistory)->moveInMiddleMiddle(),
      'middleRight' => $this->moveFilterer->filter($moveHistory)->moveInMiddleRight(),

      'bottomLeft' => $this->moveFilterer->filter($moveHistory)->moveInBottomLeft(),
      'bottomMiddle' => $this->moveFilterer->filter($moveHistory)->moveInBottomMiddle(),
      'bottomRight' => $this->moveFilterer->filter($moveHistory)->moveInBottomRight(),
    ));
  }

}