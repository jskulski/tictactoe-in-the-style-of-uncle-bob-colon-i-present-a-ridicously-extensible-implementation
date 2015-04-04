<?php


namespace JSK\TicTacToe;


class GameEdgeToEdgeTest extends \PHPUnit_Framework_TestCase {

  /** @var  Game */
  private $game;

  public function setUp() {
    $factory = new Factory();
    $this->game = $factory->createGame();
  }

  public function test_game_does_not_start_already_over()
  {
    $this->assertFalse($this->game->isOver());
  }

  public function test_game_can_evaluate_move()
  {
    $this->game->isValidMove(PlayerMove::forX(0, 0));
  }

  public function test_playing_an_invalid_move_throws_an_exception()
  {
    $this->setExpectedException(IllegalMoveException::class);
    $this->game->makeMove(PlayerMove::forX(0, 0));
    $this->game->makeMove(PlayerMove::forO(0, 0));
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


}
