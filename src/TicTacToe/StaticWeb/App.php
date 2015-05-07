<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/', function() use ($app) {
  $handler = new \JSK\TicTacToe\StaticWeb\MakeRocketGo();
  $html = $handler->displayGame();
  echo $html;
});

$app->post('/move', function() use ($app) {
  $moveName = $app->request->params('moveName');
  $handler = new \JSK\TicTacToe\StaticWeb\MakeRocketGo();
  $handler->makeMove($moveName);
  $app->redirect('/');
});

$app->run();

