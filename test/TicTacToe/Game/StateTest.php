<?php


namespace JSK\TicTacToe\Game;

class StateTest extends \PHPUnit_Framework_TestCase {

  /** @var  State */
  private $target;

  protected function setUp()
  {
    $this->target = new State();
  }

  public function test_that_empty_array_is_given_if_no_moves_have_been_made()
  {
    $moves = $this->target->getMoveHistory();
    $this->assertEquals(array(), $moves);
  }





}
