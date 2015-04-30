<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/', function() use ($app) {
  $templates = new League\Plates\Engine('templates');
  $handler = new \JSK\TicTacToe\StaticWeb\MakeRocketGo($templates);
  $html = $handler->displayGame($templates);
  echo $html;
});

$app->post('/move', function() use ($app) {
  $moveName = $app->request->params('moveName');
  $handler = new \JSK\TicTacToe\StaticWeb\MakeRocketGo();
  $handler->makeMove($moveName);
  $app->redirect('/');
});

$app->run();

