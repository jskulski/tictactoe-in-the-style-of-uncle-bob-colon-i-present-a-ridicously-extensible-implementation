<?php


namespace JSK\TicTacToe;


class GameEdgeToEdgeTest extends \PHPUnit_Framework_TestCase {

  /** @var  Game */
  private $game;

  /**
   *
   */
  public function setUp() {
    $factory = new Factory();
    $this->game = $factory->createGame();
  }

  public function test_can_make_move()
  {
    $move = PlayerMove::forX(2, 3);
    $this->game->makeMove($move);
  }

  public function test_game_is_over_after_nine_moves_made()
  {
    $this->game->makeMove(PlayerMove::forX(-1, -1));
    $this->game->makeMove(PlayerMove::forO(-1,  0));
    $this->game->makeMove(PlayerMove::forX(-1,  1));
    $this->game->makeMove(PlayerMove::forO( 0, -1));
    $this->game->makeMove(PlayerMove::forX( 0,  0));
    $this->game->makeMove(PlayerMove::forO( 0,  1));
    $this->game->makeMove(PlayerMove::forX( 1, -1));
    $this->game->makeMove(PlayerMove::forO( 1,  1));
    $this->game->makeMove(PlayerMove::forX( 1,  0));

    $this->assertTrue($this->game->isOver());
  }

  public function test_game_does_not_start_already_over()
  {
    $this->assertFalse($this->game->isOver());
  }

  public function test_game_can_evaluate_move()
  {
    $this->game->isValidMove(PlayerMove::forX(0, 0));
  }

  public function test_X_in_center_is_valid_move()
  {
    $moveIsValid = $this->game->isValidMove(PlayerMove::forX(0, 0));
    $this->assertTrue($moveIsValid);
  }

  public function test_making_X_move_twice_in_a_row_is_invalid()
  {
    $this->game->makeMove(PlayerMove::forX(0, 0));
    $moveIsValid = $this->game->isValidMove(PlayerMove::forX(1, 0));
    $this->assertFalse($moveIsValid);
  }

  public function test_playing_where_someone_has_played_is_invalid()
  {
    $this->game->makeMove(PlayerMove::forX(0, 0));
    $this->assertFalse($this->game->isValidMove(PlayerMove::forO(0, 0)));
  }

  public function test_playing_an_invalid_move_throws_an_exception()
  {
    $this->setExpectedException(IllegalMoveException::class);
    $this->game->makeMove(PlayerMove::forX(0, 0));
    $this->game->makeMove(PlayerMove::forO(0, 0));
  }

  public function test_playing_where_you_played_before_is_invalid()
  {
    $this->setExpectedException(IllegalMoveException::class);
    $this->game->makeMove(PlayerMove::forX(0, 0));
    $this->game->makeMove(PlayerMove::forO(0, 1));
    $this->game->makeMove(PlayerMove::forX(0, 0));
  }

  public function test_game_can_be_created_in_any_valid_state()
  {
//    $game = new Game($gameStateXHasWon);
//    $this->assertTrue(
//      $game->isOver()
//    );
  }


}
