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
  /** @var Move */
  private $topRightMove;

  /** @var Move */
  private $middleLeftMove;
  /** @var Move */
  private $middleMiddleMove;
  /** @var Move */
  private $middleRightMove;

  /** @var Move */
  private $bottomLeftMove;
  /** @var Move */
  private $bottomMiddleMove;
  /** @var Move */
  private $bottomRightMove;

  public function setUp()
  {
    $this->target = new MoveFilterer();

    $this->topLeftMove = PlayerMove::forO(-1, -1);
    $this->topMiddleMove = PlayerMove::forX(-1, 0);
    $this->topRightMove = PlayerMove::forO(-1, 1);

    $this->middleLeftMove = PlayerMove::forO(0, -1);
    $this->middleMiddleMove = PlayerMove::forX(0, 0);
    $this->middleRightMove = PlayerMove::forO(0, 1);

    $this->bottomLeftMove = PlayerMove::forO(1, -1);
    $this->bottomMiddleMove = PlayerMove::forX(1, 0);
    $this->bottomRightMove = PlayerMove::forO(1, 1);

    $this->moveHistory = array(
      new NullMove(),
      PlayerMove::forX(0, 0),
      $this->topLeftMove,
      $this->topMiddleMove,
      $this->topRightMove,
      PlayerMove::forX(0, 1),
      $this->middleLeftMove,
      $this->middleMiddleMove,
      $this->middleRightMove,
      PlayerMove::forX(1, 1),
      $this->bottomLeftMove,
      $this->bottomMiddleMove,
      $this->bottomRightMove,
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

  public function test_given_a_list_of_moves_we_retrieve_the_top_right()
  {
    $move = $this->target->filter($this->moveHistory)->moveInTopRight();
    $this->assertEquals($move, $this->topRightMove);
  }

}
