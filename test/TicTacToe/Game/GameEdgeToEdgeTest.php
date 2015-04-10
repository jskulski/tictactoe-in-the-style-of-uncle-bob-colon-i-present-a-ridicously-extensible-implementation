<?php


namespace JSK\TicTacToe\Game;


class GameEdgeToEdgeTest extends \PHPUnit_Framework_TestCase {

  /** @var  Game */
  private $game;

  public function setUp() {
    $factory = new Factory();
    $this->game = $factory->createGame();
  }

  public function test_tied_game_is_over_after_nine_moves_made()
  {
    $moves = array(
      PlayerMove::forX(-1, -1),
      PlayerMove::forO(-1,  1),
      PlayerMove::forX(-1,  0),
      PlayerMove::forO( 0, -1),
      PlayerMove::forX( 0,  1),
      PlayerMove::forO( 0,  0),
      PlayerMove::forX( 1, -1),
      PlayerMove::forO( 1,  0),
      PlayerMove::forX( 1,  1),
    );
    $state = $this->playMoves($this->game, $moves);

    $this->assertTrue($state->isOver());
    $this->assertFalse($state->winnerIsX());
    $this->assertFalse($state->winnerIsO());
    $this->assertTrue($state->isTiedGame());
  }

  public function test_game_where_X_wins_top_row_has_expected_outcome() {
    $moves = array(
      PlayerMove::forX(-1, -1),
      PlayerMove::forO( 0,  0),
      PlayerMove::forX(-1,  0),
      PlayerMove::forO( 1,  0),
      PlayerMove::forX(-1,  1)
    );
    $state = $this->playMoves($this->game, $moves);

    $this->assertTrue($state->isOver());
    $this->assertTrue($state->winnerIsX());
    $this->assertFalse($state->winnerIsO());
    $this->assertFalse($state->isTiedGame());
  }


  public function test_game_where_O_wins_left_column_has_expected_outcome() {
    $moves = array(
      PlayerMove::forX( 0,  0),
      PlayerMove::forO(-1, -1),
      PlayerMove::forX(-1,  0),
      PlayerMove::forO( 0, -1),
      PlayerMove::forX(-1,  1),
      PlayerMove::forO( 1, -1)
    );
    $state = $this->playMoves($this->game, $moves);

    $this->assertTrue($state->isOver());
    $this->assertFalse($state->winnerIsX());
    $this->assertTrue($state->winnerIsO());
    $this->assertFalse($state->isTiedGame());
  }

  public function test_that_it_is_Os_turn_given_a_history_with_player_O_as_last_player()
  {
    $moves = array(
      PlayerMove::forX(0, 0)
    );
    $state = $this->playMoves($this->game, $moves);

    $this->assertTrue($state->isPlayerOTurn());
    $this->assertFalse($state->isPlayerXTurn());
  }

//  public function test_that_it_is_Xs_turn_given_a_history_with_player_O_as_last_player()
//  {
//    $moves = array(
//      PlayerMove::forX(0, 0),
//      PlayerMove::forO(1, 1)
//    );
//    $state = $this->playMoves($this->game, $moves);
//
//    $this->assertTrue($state->isPlayerXTurn());
//    $this->assertFalse($state->isPlayerOTurn());
//  }

//  public function test_that_it_cant_be_both_X_and_O_turn()
//  {
//    $this->assertTrue($this->target->isPlayerXTurn());
//    $this->assertFalse($this->target->isPlayerOTurn());
//  }


  /**
   * @param Game $game
   * @param Move[] $moves
   * @throws IllegalMoveException
   */
  private function playMoves(Game $game, array $moves)
  {
    $state = new State();
    foreach ($moves as $move) {
      $state = $game->makeMove($move, $state);
    }
    return $state;
  }

}
