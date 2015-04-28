<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\Board;
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
      'topLeft' => $this->renderMove($this->moveFilterer->filter($moveHistory)->moveInTopLeft()),
      'topMiddle' => $this->renderMove($this->moveFilterer->filter($moveHistory)->moveInTopMiddle()),
      'topRight' => $this->renderMove($this->moveFilterer->filter($moveHistory)->moveInTopRight()),

      'middleLeft' => $this->renderMove($this->moveFilterer->filter($moveHistory)->moveInMiddleLeft()),
      'middleMiddle' => $this->renderMove($this->moveFilterer->filter($moveHistory)->moveInMiddleMiddle()),
      'middleRight' => $this->renderMove($this->moveFilterer->filter($moveHistory)->moveInMiddleRight()),

      'bottomLeft' => $this->renderMove($this->moveFilterer->filter($moveHistory)->moveInBottomLeft()),
      'bottomMiddle' => $this->renderMove($this->moveFilterer->filter($moveHistory)->moveInMiddleMiddle()),
      'bottomRight' => $this->renderMove($this->moveFilterer->filter($moveHistory)->moveInBottomRight()),
    ));
  }

}