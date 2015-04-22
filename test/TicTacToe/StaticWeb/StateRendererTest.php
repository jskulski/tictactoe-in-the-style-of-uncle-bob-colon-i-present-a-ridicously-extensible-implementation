<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\State;

class StateRendererTest extends \PHPUnit_Framework_TestCase {

  public function test_create_new_object()
  {
    $target = new StateRenderer();
  }

  public function test_given_state_without_moves_renders_empty_board()
  {
    $target = new StateRenderer();
    $rendered = $target->render(new State());
    $this->assertEquals('---\n---\n---', $rendered);
  }

}