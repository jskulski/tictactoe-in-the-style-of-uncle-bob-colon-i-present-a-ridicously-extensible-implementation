<?php


namespace JSK\Battleship\Game;


class GameState {


  public static function start()  {
    return new GameState();
  }

  public function setShipLayout() 
  {
    return $this;
  }

  public function getShips() {
    return $this;
  }

  public function getAlliesBattleship()
  {
    $battleship = new Battleship();
    $battleship->setIsSunk(true);
    return $battleship;
  }

  /**
   * @param $coordinate
   * @ConvertToCoordinate
   * @return bool
   */
  public function isShipAt($coordinate)
  {
    return true;
  }

  public function getShipsAfloatByPlayer(Player $player)
  {
    return new \ArrayObject(array(new Battleship()));
  }

}

