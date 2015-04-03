<?php


namespace JSK\TicTacToe;


class RefereeTest extends \PHPUnit_Framework_TestCase {
  public function test_referee_wont_accept_a_move_from_O_if_O_made_the_last_move()
  {
    $referee = new Referee();
    $moveStack = array(
      PlayerMove::forO(1, 1)
    );
    $this->assertFalse(
      $referee->makeCall(PlayerMove::forO(0, 1), $moveStack)
    );
  }
}
