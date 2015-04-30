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
  $move = \JSK\TicTacToe\Game\PlayerMove::forX(0, 0);
  $state = new \JSK\TicTacToe\Game\State();
  $state->addMoveToMoveHistory($move);


  $template = new League\Plates\Engine('templates');
  $moveFilterer = new \JSK\TicTacToe\Game\MoveFilterer();
  $stateRenderer = new \JSK\TicTacToe\StaticWeb\StateRenderer($template, $moveFilterer);
  $html = $stateRenderer->renderBoard($state->getMoveHistory());
  echo $html;
});

$app->run();

