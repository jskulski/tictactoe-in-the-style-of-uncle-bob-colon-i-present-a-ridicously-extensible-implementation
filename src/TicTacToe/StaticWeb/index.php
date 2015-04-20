<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/', function() use ($app) {
  $stateRenderer = new StateRenderer();
  $state = new \JSK\TicTacToe\Game\State();
  $html = $stateRenderer->render($state);
  echo $html;
});

$app->run();

