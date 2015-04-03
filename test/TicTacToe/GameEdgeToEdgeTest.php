<?php


namespace JSK\TicTacToe;


class GameEdgeToEdgeTest extends \PHPUnit_Framework_TestCase {

  public function test_can_make_move()
  {
    $game = new Game();
    $move = PlayerMove::forX(2, 3);
    $game->makeMove($move);
  }

  public function test_game_is_over_after_nine_moves_made()
  {
    $game = new Game();

    $game->makeMove(PlayerMove::forX(-1, -1));
    $game->makeMove(PlayerMove::forO(-1,  0));
    $game->makeMove(PlayerMove::forX(-1,  1));
    $game->makeMove(PlayerMove::forO( 0, -1));
    $game->makeMove(PlayerMove::forX( 0,  0));
    $game->makeMove(PlayerMove::forO( 0,  1));
    $game->makeMove(PlayerMove::forX( 1, -1));
    $game->makeMove(PlayerMove::forO( 1,  1));
    $game->makeMove(PlayerMove::forX( 1,  0));

    $this->assertTrue($game->isOver());
  }

  public function test_game_does_not_start_already_over()
  {
    $game = new Game();
    $this->assertFalse($game->isOver());
  }

  public function test_game_can_evaluate_move()
  {
    $game = new Game();
    $game->isValidMove(PlayerMove::forX(0, 0));
  }

  public function test_X_in_center_is_valid_move()
  {
    $game = new Game();
    $moveIsValid = $game->isValidMove(PlayerMove::forX(0, 0));
    $this->assertTrue($moveIsValid);
  }

  public function test_making_X_move_twice_in_a_row_is_invalid()
  {
    $game = new Game();
    $game->makeMove(PlayerMove::forX(0,0));
    $moveIsValid = $game->isValidMove(PlayerMove::forX(1, 0));
    $this->assertFalse($moveIsValid);
  }

  public function test_playing_where_someone_has_played_is_invalid()
  {
    $game = new Game();
    $game->makeMove(PlayerMove::forX(0, 0));
    $this->assertFalse($game->isValidMove(PlayerMove::forO(0, 0)));
  }

  public function test_playing_an_invalid_move_throws_an_exception()
  {
    $this->setExpectedException(IllegalMoveException::class);
    $game = new Game();
    $game->makeMove(PlayerMove::forX(0, 0));
    $game->makeMove(PlayerMove::forO(0, 0));
  }

}
