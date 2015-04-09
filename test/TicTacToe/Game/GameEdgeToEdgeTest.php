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
    $state = $this->game->makeMove(PlayerMove::forX( 1,  0));

    $this->assertTrue($state->isOver());
  }

  public function test_game_where_X_wins_top_row_has_expected_outcome() {

    $moves = array(
      PlayerMove::forX(-1, -1),
      PlayerMove::forO( 0,  0),
      PlayerMove::forX(-1,  0),
      PlayerMove::forO( 1,  0),
      PlayerMove::forX(-1,  1)
    );

    $state = new State();
    foreach ($moves as $move) {
      $state = $this->game->makeMoveWithState($move, $state);
    }
  }



}
