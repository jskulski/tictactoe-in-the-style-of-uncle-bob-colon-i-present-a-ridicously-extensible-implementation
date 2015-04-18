<?php


namespace JSK\Battleship\Game;


class GameStateTest extends \PHPUnit_Framework_TestCase
{

  public function test_game_state_exists()
  {
    $target = new GameState();
  }

  public function test_game_state_reports_ships_afloat_for_a_player()
  {
    $target = new GameState();
    $player = new Player();
    $shipsAfloat = $target->getShipsAfloatByPlayer($player);
  }


}
