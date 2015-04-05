<?php


namespace JSK\TicTacToe\Game;


class GameTest extends \PHPUnit_Framework_TestCase {

  public function test_game_checks_with_referee_to_see_if_move_is_valid()
  {
    $refereeSpy = new RefereeSpy();
    $target = new Game($refereeSpy);
    $move = new PlayerMoveStub('JSK', 123, 321);

    $target->makeMove($move);
    $this->assertEquals($refereeSpy->moveMakeCallCalledWith(), $move);
  }
}

class RefereeSpy extends Referee {

  /** @var  Move */
  private $move;

  function __construct() { }

  /**
   * @param Move $move
   * @param array $moveHistory
   * @return bool
   */
  public function makeCall(Move $move, array $moveHistory)
  {
    $this->move = $move;
    return true;
  }


  public function moveMakeCallCalledWith()
  {
    return $this->move;
  }

}

class PlayerMoveStub extends PlayerMove {
  /** @var  */
  private $player;
  private $row;
  private $column;

  public function __construct($player, $row, $column)
  {
    $this->player = $player;
    $this->row = $row;
    $this->column = $column;
  }
}

