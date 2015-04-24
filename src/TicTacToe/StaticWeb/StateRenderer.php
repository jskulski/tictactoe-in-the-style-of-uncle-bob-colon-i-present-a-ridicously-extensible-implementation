<?php


namespace JSK\TicTacToe\StaticWeb;


class StateRenderer {

  /** @var  Template */
  private $template;

  function __construct($template)
  {
    $this->template = $template;
  }

  public function render(\JSK\TicTacToe\Game\State $state)
  {
    return $this->template->render($state);
  }

}