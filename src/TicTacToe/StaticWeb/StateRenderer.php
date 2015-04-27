<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\Move;

class StateRenderer {

  /** @var  Template */
  private $template;

  function __construct($template)
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
      return 'X';
      return $this->template->render('x');
    }
    else if ($move->isO()) {
      return 'O';
    }
    else if ($move->isNullObject()) {
      return '-';
    }
    else {
      throw new \LogicException();
    }
  }

}