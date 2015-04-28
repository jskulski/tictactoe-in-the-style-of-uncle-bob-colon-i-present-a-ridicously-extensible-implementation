<?php


namespace TicTacToe\Game;


use JSK\TicTacToe\Game\MoveFilterer;
use JSK\TicTacToe\Game\NullMove;
use JSK\TicTacToe\Game\PlayerMove;

class MoveFiltererTest extends \PHPUnit_Framework_TestCase {

  public function test_given_a_list_of_moves_we_retrieve_the_top_left()
  {
    $moveFilterer = new MoveFilterer();
    $topLeftMove = PlayerMove::forO(-1, -1);
    $moveHistory = array(
      new NullMove(),
      $topLeftMove,
      PlayerMove::forX(0, 0)
    );
    $move = $moveFilterer->filter($moveHistory)->movesInTopLeft();
    $this->assertEquals($move, $topLeftMove);
  }
}
