<?php


namespace JSK\TicTacToe;


class Factory {

  /**
   * @return Game;
   */
  public function createGame()
  {
    return new Game();
  }
}