<?php


namespace JSK\TicTacToe;


class FactoryTest extends \PHPUnit_Framework_TestCase {


  /** @var  Factory */
  private $target;

  protected function setUp()
  {
    $this->target = new Factory();
  }

  public function test_factory_can_create_referee()
  {
    $referee = $this->target->createReferee();
    $this->assertInstanceOf(Referee::class, $referee);
  }

  public function test_factory_can_create_game()
  {
    $game = $this->target->createGame();
    $this->assertInstanceOf(Game::class, $game);
  }


}
