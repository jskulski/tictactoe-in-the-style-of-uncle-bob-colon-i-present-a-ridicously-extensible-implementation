<?php


namespace JSK\TicTacToe\Game;


class Factory {

  /** @var  Referee */
  private $referee;
  /** @var  Game */
  private $game;
  /** @var  MoveFilterer */
  private $moveFilterer;

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
      $this->referee = new Referee($this->createMoveFilterer());
    }
    return $this->referee;
  }

  public function createMoveFilterer()
  {
    if (!$this->moveFilterer) {
      $this->moveFilterer= new MoveFilterer();
    }
    return $this->moveFilterer;
  }
}