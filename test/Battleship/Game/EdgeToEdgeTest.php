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
    $shipLayout = ShipLayout::start()->placeShip(
      new Battleship(),
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

    $battleship = $gameState->getShips()->getAlliesBattleship();
    $this->assertTrue($battleship->isSunk());
  }


}
