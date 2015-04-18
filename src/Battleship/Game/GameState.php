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
    return new Battleship();
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

}

