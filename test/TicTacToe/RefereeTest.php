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
    $moveHistory = array();
    $this->assertTrue(
      $this->target->makeCall(PlayerMove::forX(0, 0), $moveHistory)
    );
  }

  public function test_making_X_move_twice_in_a_row_is_invalid()
  {
    $moveHistory = array(
      PlayerMove::forX(0, 0)
    );
    $move = PlayerMove::forX(1, 1);
    $this->assertFalse($this->target->makeCall($move, $moveHistory));
  }

  public function test_playing_where_opponent_has_played_is_invalid()
  {
    $moveHistory = array(
      PlayerMove::forX(0, 0)
    );
    $move = PlayerMove::forO(0, 0);
    $this->assertFalse($this->target->makeCall($move, $moveHistory));
  }

  public function test_playing_where_you_have_played_is_invalid()
  {
    $moveHistory = array(
      PlayerMove::forX(0, 0),
      PlayerMove::forO(1, 0)
    );
    $move = PlayerMove::forO(0, 0);
    $this->assertFalse($this->target->makeCall($move, $moveHistory));
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

  public function test_X_is_winner_if_they_mark_all_top_row()
  {
    $moveHistory = array(
      PlayerMove::forX(-1, -1),
      PlayerMove::forO( 0,  0),
      PlayerMove::forX(-1,  0),
      PlayerMove::forO( 0,  1),
      PlayerMove::forX(-1,  1)
    );
    $this->assertTrue($this->target->hasWinner($moveHistory));
    $this->assertTrue($this->target->winnerIsX($moveHistory));
  }

  public function test_O_is_winner_if_they_mark_all_top_row()
  {
    $moveHistory = array(
      PlayerMove::forX( 1,  1),
      PlayerMove::forO(-1, -1),
      PlayerMove::forX( 0,  0),
      PlayerMove::forO(-1,  0),
      PlayerMove::forX( 0,  1),
      PlayerMove::forO(-1,  1)
    );
    $this->assertTrue($this->target->hasWinner($moveHistory));
    $this->assertTrue($this->target->winnerIsO($moveHistory));
  }

  public function test_O_is_winner_if_they_mark_all_middle_row()
  {
    $moveHistory = array(
      PlayerMove::forX( 1,  1),
      PlayerMove::forO( 0, -1),
      PlayerMove::forX( 1,  0),
      PlayerMove::forO( 0,  0),
      PlayerMove::forX(-1,  1),
      PlayerMove::forO( 0,  1)
    );
    $this->assertTrue($this->target->hasWinner($moveHistory));
    $this->assertTrue($this->target->winnerIsO($moveHistory));
  }

  public function test_X_is_winner_if_they_mark_all_middle_row()
  {
    $moveHistory = array(
      PlayerMove::forX( 0, -1),
      PlayerMove::forO( 1,  0),
      PlayerMove::forX( 0,  0),
      PlayerMove::forO(-1,  1),
      PlayerMove::forX( 0,  1)
    );
    $this->assertTrue($this->target->hasWinner($moveHistory));
    $this->assertTrue($this->target->winnerIsX($moveHistory));
  }

  public function test_X_is_winner_if_they_mark_all_bottom_row()
  {
    $moveHistory = array(
      PlayerMove::forX( 1, -1),
      PlayerMove::forO( 1,  0),
      PlayerMove::forX( 1,  0),
      PlayerMove::forO(-1,  1),
      PlayerMove::forX( 1,  1)
    );
    $this->assertTrue($this->target->hasWinner($moveHistory));
    $this->assertTrue($this->target->winnerIsX($moveHistory));
  }

  public function test_O_is_winner_if_they_mark_all_bottom_row()
  {
    $moveHistory = array(
      PlayerMove::forX( 0,  0),
      PlayerMove::forO( 1, -1),
      PlayerMove::forX( 0, -1),
      PlayerMove::forO( 1,  0),
      PlayerMove::forX(-1,  1),
      PlayerMove::forO( 1,  1)
    );
    $this->assertTrue($this->target->hasWinner($moveHistory));
    $this->assertTrue($this->target->winnerIsO($moveHistory));
  }

  public function test_X_is_winner_if_they_mark_all_left_column()
  {
    $moveHistory = array(
      PlayerMove::forX(-1, -1),
      PlayerMove::forO( 0,  0),
      PlayerMove::forX( 9, -1),
      PlayerMove::forO( 0,  1),
      PlayerMove::forX( 1, -1)
    );
    $this->assertTrue($this->target->hasWinner($moveHistory));
    $this->assertTrue($this->target->winnerIsX($moveHistory));
  }

  public function test_X_is_winner_if_they_mark_all_middle_column()
  {
    $moveHistory = array(
      PlayerMove::forX(-1, 0),
      new NullMove(),
      PlayerMove::forX( 0, 0),
      new NullMove(),
      PlayerMove::forX( 1, 0)
    );
    $this->assertTrue($this->target->hasWinner($moveHistory));
    $this->assertTrue($this->target->winnerIsX($moveHistory));
  }

}
