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
    $gameEngine = new GameEngine();
    $shipLayout = ShipLayout::start()->placeShip(
      new Battleship(),
      Coordinate::at('A1'),
      Coordinate::at('A4')
    );
    $gameState = GameState::start()->setShipLayout($shipLayout);

    $gameState = $this->playMoves(
      array('A1', 'A2', 'A3', 'A4'),
      $gameEngine,
      $gameState
    );

    $battleship = $gameState->getShips()->getAlliesBattleship();
    $this->assertTrue($battleship->isSunk());
  }

  /**
   * @param $gameEngine
   * @param $gameState
   * @return mixed
   */
  private function playMoves($moves, GameEngine $gameEngine, GameState $gameState)
  {
    foreach ($moves as $move) {
      $gameState = $gameEngine->makeMove(
        PlayerMove::forAllies(Coordinate::at($move)),
        $gameState
      );
    }
    return $gameState;
  }


}
