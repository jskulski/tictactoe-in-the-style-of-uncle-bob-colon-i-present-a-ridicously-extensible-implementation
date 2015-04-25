<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/', function() use ($app) {
  $template = new League\Plates\Engine('templates');
  $html = $template->render('board');
  echo $html;
//  $templat = new \JSK\TicTacToe\StaticWeb\Template();
//  $stateRenderer = new \JSK\TicTacToe\StaticWeb\StateRenderer();
//  $state = new \JSK\TicTacToe\Game\State();
//  $html = $stateRenderer->render($state);
});

$app->run();

