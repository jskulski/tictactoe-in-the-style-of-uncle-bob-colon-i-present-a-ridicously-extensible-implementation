<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/', function() use ($app) {
  $template = new League\Plates\Engine('templates');
  $stateRenderer = new \JSK\TicTacToe\StaticWeb\StateRenderer($template);
  $state = new \JSK\TicTacToe\Game\State();
//  $board = new Board($state->getMoveHistory());
  $html = $stateRenderer->renderMove(\JSK\TicTacToe\Game\PlayerMove::forO(-1,-1));
  echo $html;
});

$app->run();

