<?php


namespace JSK\TicTacToe\Game;


class GameEdgeToEdgeTest extends \PHPUnit_Framework_TestCase {

  /** @var  Game */
  private $game;

  public function setUp() {
    $factory = new Factory();
    $this->game = $factory->createGame();
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
