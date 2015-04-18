<?php


namespace JSK\Battleship\Game;


use PHPUnit_Framework_TestCase;

class EdgeToEdgeTest extends PHPUnit_Framework_TestCase
{

  public function test_can_create_game()
  {
    $game = new GameEngine();
  }

  public function test_given_a_battleship_we_can_sink_it()
  {
    $game = new GameEngine();
    $battleship = new Battleship();
    $shipLayout = ShipLayout::start()->placeShip(
      $battleship,
      Coordinate::at('A1'),
      Coordinate::at('A4')
    );
    $gameState = GameState::start()->setShipLayout($shipLayout);

    $gameState = $game->makeMove(
      PlayerMove::forAllies(Coordinate::at('A1')),
      $gameState
    );
    $gameState = $game->makeMove(
      PlayerMove::forAllies(Coordinate::at('A2')),
      $gameState
    );
    $gameState = $game->makeMove(
      PlayerMove::forAllies(Coordinate::at('A3')),
      $gameState
    );
    $gameState = $game->makeMove(
      PlayerMove::forAllies(Coordinate::at('A4')),
      $gameState
    );



  }


}
