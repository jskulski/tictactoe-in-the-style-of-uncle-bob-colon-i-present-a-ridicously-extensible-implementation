<?php


namespace TicTacToe\Game;


use JSK\TicTacToe\Game\Move;
use JSK\TicTacToe\Game\MoveFilterer;
use JSK\TicTacToe\Game\NullMove;
use JSK\TicTacToe\Game\PlayerMove;

class MoveFiltererTest extends \PHPUnit_Framework_TestCase {

  /** @var MoveFilterer */
  private $target;
  /** @var Move[] */
  private $moveHistory;

  /** @var Move */
  private $topLeftMove;
  /** @var Move */
  private $topMiddleMove;

  public function setUp()
  {
    $this->target = new MoveFilterer();
    $this->topLeftMove = PlayerMove::forO(-1, -1);
    $this->topMiddleMove = PlayerMove::forX(-1, 0);
    $this->moveHistory = array(
      new NullMove(),
      PlayerMove::forX(0, 0),
      $this->topLeftMove,
      $this->topMiddleMove,
      PlayerMove::forX(0, 0),
    );

  }

  public function test_given_a_list_of_moves_we_retrieve_the_top_left()
  {
    $move = $this->target->filter($this->moveHistory)->moveInTopLeft();
    $this->assertEquals($move, $this->topLeftMove);
  }

  public function test_given_a_list_of_moves_we_retrieve_the_top_middle()
  {
    $move = $this->target->filter($this->moveHistory)->moveInTopMiddle();
    $this->assertEquals($move, $this->topMiddleMove);
  }

}
