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

  public function test_that_move_performed_is_stored_in_move_history()
  {
    $move = PlayerMove::forX(1, 1);
    $this->target->addMoveToMoveHistory($move);
    $moveHistory = $this->target->getMoveHistory();
    $this->assertEquals($move, $moveHistory[0]);
  }

  public function test_initial_state_is_player_X_turn()
  {
    $this->assertTrue($this->target->isPlayerXTurn());
  }


}
