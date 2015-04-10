<?php


namespace JSK\Battleship\Game;


use PHPUnit_Framework_TestCase;

class EdgeToEdgeTest extends PHPUnit_Framework_TestCase {

  public function test_can_create_game()
  {
    $game = new GameEngine();
  }

  public function test_can_make_move()
  {
    $game = new GameEngine();
    $game->makeMove('A5');
  }

  public function test_can_place_a_battleship()
  {
    $boardArranger = new BoardArranger();
    $state = $boardArranger->placeShip(
      new Battleship(),
      'A1',
      'A4'
    );

    $this->assertTrue($state->isShipAt('A1'));
  }

//  public function test_no_ship_initial_state()
//  {
//    $state = new GameState();
//    $this->assertFalse($state->isShipAt('A1'));
//  }

//  public function test_sinking_a_battleship_sinks_a_battleship()
//  {
//    $state = new GameState();
//    $game = new GameEngine();
//    $state = $game->makeMove('A1', $state);
//    $state = $game->makeMove('A2', $state);
//    $state = $game->makeMove('A3', $state);
//    $state = $game->makeMove('A4', $state);
//  }
}