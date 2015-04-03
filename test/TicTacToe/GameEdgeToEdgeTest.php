<?php


namespace JSK\TicTacToe;


class GameEdgeToEdgeTest extends \PHPUnit_Framework_TestCase {

  public function test_can_make_move()
  {
    $game = new Game();
    $move = Move::forX(2, 3);
    $game->makeMove($move);
  }

  public function test_game_is_over_after_nine_moves_made()
  {
    $game = new Game();

    $game->makeMove(Move::forX(-1, -1));
    $game->makeMove(Move::forO('O', -1,  0));
    $game->makeMove(Move::forX(-1,  1));
    $game->makeMove(Move::forO( 0, -1));
    $game->makeMove(Move::forX( 0,  0));
    $game->makeMove(Move::forO( 0,  1));
    $game->makeMove(Move::forX( 1, -1));
    $game->makeMove(Move::forO( 1,  1));
    $game->makeMove(Move::forX( 1,  0));

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
    $game->isValidMove(Move::forX(0, 0));
  }

  public function test_X_in_center_is_valid_move()
  {
    $game = new Game();
    $moveIsValid = $game->isValidMove(Move::forX(0, 0));
    $this->assertTrue($moveIsValid);
  }

  public function test_making_X_move_twice_in_a_row_is_invalid()
  {
    $game = new Game();
    $game->makeMove(Move::forX(0,0));
    $moveIsValid = $game->isValidMove(Move::forX(1, 0));
    $this->assertFalse($moveIsValid);
  }


}
