<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\MoveFilterer;
use JSK\TicTacToe\Game\NullMove;
use JSK\TicTacToe\Game\State;
use JSK\TicTacToe\Game\StateRenderer;

class MakeRocketGo {

  public function displayGame() {
    $templates = new \League\Plates\Engine(__DIR__ .'/templates');
    $moveFilterer = new MoveFilterer();
    $stateRenderer = new StateRenderer($templates, $moveFilterer);
    $state = new State();
    return $stateRenderer->renderBoard($state->getMoveHistory());
  }

  public function makeMove($moveName) {
    $move = $this->convertMoveNameParameterToMove($moveName);
    $state = new State();
    $state->addMoveToMoveHistory($move);
  }

  /**
   * @param $moveName
   * @return \JSK\TicTacToe\Game\PlayerMove
   */
  private function convertMoveNameParameterToMove($moveName)
  {
    switch ($moveName) {
      case 'topLeft':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(-1, -1);
        break;
      case 'topMiddle':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(-1, 0);
        break;
      case 'topRight':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(-1, 1);
        break;

      case 'middleLeft':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(0, -1);
        break;
      case 'middleMiddle':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(0, 0);
        break;
      case 'middleRight':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(0, 1);
        break;

      case 'bottomLeft':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(1, -1);
        break;
      case 'bottomMiddle':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(1, 0);
        break;
      case 'bottomRight':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(1, 1);
        break;
      default:
        $move = new NullMove();
        break;
    }
    return $move;
  }

}
