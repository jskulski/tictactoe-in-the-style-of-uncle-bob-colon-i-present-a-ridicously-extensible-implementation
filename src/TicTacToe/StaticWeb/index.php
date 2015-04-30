<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/', function() use ($app) {
  $template = new League\Plates\Engine('templates');
  $moveFilterer = new \JSK\TicTacToe\Game\MoveFilterer();
  $stateRenderer = new \JSK\TicTacToe\StaticWeb\StateRenderer($template, $moveFilterer);
  $state = new \JSK\TicTacToe\Game\State();
  $html = $stateRenderer->renderBoard($state->getMoveHistory());
  echo $html;
});

$app->post('/move', function() use ($app) {
  $moveName = $app->request->params('moveName');

  switch ($moveName) {
    case 'topLeft':
      $move = \JSK\TicTacToe\Game\PlayerMove::forX(-1, -1);
      break;
    case 'topMiddle':
      $move = \JSK\TicTacToe\Game\PlayerMove::forX(-1,  0);
      break;
    case 'topRight':
      $move = \JSK\TicTacToe\Game\PlayerMove::forX(-1,  1);
      break;

    case 'middleLeft':
      $move = \JSK\TicTacToe\Game\PlayerMove::forX( 0, -1);
      break;
    case 'middleMiddle':
      $move = \JSK\TicTacToe\Game\PlayerMove::forX( 0,  0);
      break;
    case 'middleRight':
      $move = \JSK\TicTacToe\Game\PlayerMove::forX( 0,  1);
      break;

    case 'bottomLeft':
      $move = \JSK\TicTacToe\Game\PlayerMove::forX( 1, -1);
      break;
    case 'bottomMiddle':
      $move = \JSK\TicTacToe\Game\PlayerMove::forX( 1,  0);
      break;
    case 'bottomRight':
      $move = \JSK\TicTacToe\Game\PlayerMove::forX( 1,  1);
      break;
  }

  $state = new \JSK\TicTacToe\Game\State();
  $state->addMoveToMoveHistory($move);

  $template = new League\Plates\Engine('templates');
  $moveFilterer = new \JSK\TicTacToe\Game\MoveFilterer();
  $stateRenderer = new \JSK\TicTacToe\StaticWeb\StateRenderer($template, $moveFilterer);
  $html = $stateRenderer->renderBoard($state->getMoveHistory());
  echo $html;
});

$app->run();

