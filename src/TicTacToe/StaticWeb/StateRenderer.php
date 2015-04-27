<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\Board;
use JSK\TicTacToe\Game\Move;
use League\Plates\Engine;

class StateRenderer {

  /** @var  Engine */
  private $template;

  function __construct(Engine $template)
  {
    $this->template = $template;
  }

//  /**
//   * @param \JSK\TicTacToe\Game\State $state
//   * @return mixed
//   */
//  public function render(\JSK\TicTacToe\Game\State $state)
//  {
//    return $this->template->render($state);
//  }

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
    $board = new Board($moveHistory);
    return $this->template->render('board', array('board' => $board));
  }

}