<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

class SlimApplicationHandlerBatman {

  public function displayGame() {
    $template = new League\Plates\Engine('templates');
    $moveFilterer = new \JSK\TicTacToe\Game\MoveFilterer();
    $stateRenderer = new \JSK\TicTacToe\Game\StateRenderer($template, $moveFilterer);
    $state = new \JSK\TicTacToe\Game\State();
    return $stateRenderer->renderBoard($state->getMoveHistory());
  }

  public function makeMove($moveName) {
    $move = $this->convertMoveNameParameterToMove($moveName);

    $state = new \JSK\TicTacToe\Game\State();
    $state->addMoveToMoveHistory($move);

    $template = new League\Plates\Engine('templates');
    $moveFilterer = new \JSK\TicTacToe\Game\MoveFilterer();
    $stateRenderer = new \JSK\TicTacToe\Game\StateRenderer($template, $moveFilterer);
    return $stateRenderer->renderBoard($state->getMoveHistory());
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
    }
    return $move;
  }

}

$app = new \Slim\Slim();
$app->get('/', function() use ($app) {
  $handler = new SlimApplicationHandlerBatman();
  $html = $handler->displayGame();
  echo $html;
});

$app->post('/move', function() use ($app) {
  $moveName = $app->request->params('moveName');
  $handler = new SlimApplicationHandlerBatman();
  $html = $handler->makeMove($moveName);
  echo $html;
});

$app->run();

