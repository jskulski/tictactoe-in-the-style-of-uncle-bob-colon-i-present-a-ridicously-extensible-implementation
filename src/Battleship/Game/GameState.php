<?php


namespace JSK\Battleship\Game;


class GameState {


  public static function start()  {
    return new GameState();
  }

  public function setShipLayout() 
  {
    
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

