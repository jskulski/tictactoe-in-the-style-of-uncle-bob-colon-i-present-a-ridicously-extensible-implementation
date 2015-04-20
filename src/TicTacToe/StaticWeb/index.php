<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

class StateRenderer {

  public function render(\JSK\TicTacToe\Game\State $state)
  {
    $html = 'hello world';
    return $html;
  }

}

$app = new \Slim\Slim();
$app->get('/', function() use ($app) {
  $stateRenderer = new StateRenderer();
  $factory = new \JSK\TicTacToe\Game\Factory;
  $game = $factory->createGame();
  $state = new \JSK\TicTacToe\Game\State();
  $html = $stateRenderer->render($state);
  echo $html;
});

$app->run();

