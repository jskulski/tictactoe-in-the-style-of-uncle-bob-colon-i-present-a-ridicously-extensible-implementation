<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\PlayerMove;
use JSK\TicTacToe\Game\State;

class StateRepositorySQLLiteIntegrationTest extends \PHPUnit_Framework_TestCase
{

  public function test_can_save_and_retrieve_state_on_new_database()
  {
    $target = new StateRepositorySQLLite();
    $state = new State();
    $state->addMoveToMoveHistory(PlayerMove::forX(-1, -1));
    $state->addMoveToMoveHistory(PlayerMove::forO(0, 1));

    $stateId = $target->save($state);

    $this->assertEquals(1, $stateId);

    $retrievedState = $target->retrieveById($stateId);

    $this->assertInstanceOf(State::class, $retrievedState);

    $this->assertEquals($retrievedState, $state);
  }
}