<?php


namespace JSK\TicTacToe;


class RefereeTest extends \PHPUnit_Framework_TestCase {

  /** @var  Referee */
  private $target;

  protected function setUp()
  {
    $this->target = new Referee();
  }

  public function test_X_in_the_center_is_valid_on_empty_board()
  {
    $this->assertTrue(
      $this->target->makeCall(PlayerMove::forX(0, 0), array())
    );
  }



  public function test_referee_wont_accept_a_move_from_O_if_O_made_the_last_move()
  {
    $moveHistory = array(
      PlayerMove::forO(1, 1)
    );
    $this->assertFalse(
      $this->target->makeCall(PlayerMove::forO(0, 1), $moveHistory)
    );
  }

  public function test()
  {
  }
}
