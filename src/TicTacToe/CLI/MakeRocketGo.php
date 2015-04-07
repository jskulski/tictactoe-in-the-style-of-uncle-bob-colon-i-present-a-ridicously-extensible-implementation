<?php


namespace JSK\TicTacToe\CLI;


use JSK\TicTacToe\Game\Factory;
use JSK\TicTacToe\Game\Game;
use JSK\TicTacToe\Game\PlayerMove;
use JSK\TicTacToe\Game\State;


class MakeRocketGo {

  /** @var Factory */
  private $factory;

  function __construct($factory)
  {
    $this->factory = $factory;
  }

  public function run()
  {
    /** @var Game $game */
    $game = $this->factory->createGame();

    $quit = false;
    $playerXTurn = true;

    while (!$quit) {
      $this->renderGameState($game->getState());
      list($row, $column) = $this->promptUser();

      if ($row == 'q' || $column == 'q') {
        $quit = true;
      }

      if ($playerXTurn) {
        $move = PlayerMove::forX($row, $column);
      }
      else {
        $move = PlayerMove::forO($row, $column);
      }

      if ($game->isValidMove($move)) {
        $game->makeMove($move);
        $playerXTurn = !$playerXTurn;
      }
      else {
        \cli\line("Sorry that move was invalid. Try again");
      }
    }
  }

  public function renderGameState(State $state) {
    $legend = array('   ', ' -1 ', ' 0 ', ' 1 ');
    $markersOnBoard = array(
      array(' - ', ' - ', ' - '),
      array(' - ', ' - ', ' - '),
      array(' - ', ' - ', ' - ')
    );
    $moves = $state->getMoveHistory();
    foreach ($moves as $move) {
      /** @var $move Move */
      $marker = $move->isX() ? 'X' : 'O';
      $row = $move->getRow() - 1;
      $col = $move->getColumn() - 1;
      $markersOnBoard[$row][$col] = $marker;
    }

    $table = new \cli\Table();
    $table->setRows($markersOnBoard);
    $table->display();
  }


  /**
   * @return array
   */
  public function promptUser()
  {
    \cli\line('Make a move');
    $row = \cli\Streams::prompt('Row', null, '[1/2/3] ? ');
    $column = \cli\Streams::prompt('Column', null, '[1/2/3] ? ');
    return array($row - 2, $column - 2);
  }

}
