<?php


namespace JSK\TicTacToe;


class Factory {

  /** @var  Referee */
  private $referee;

  /**
   * @return Game;
   */
  public function createGame()
  {
    return new Game($this->createReferee());
  }

  public function createReferee()
  {
    if (!$this->referee) {
      $this->referee = new Referee();
    }
    return $this->referee;
  }
}