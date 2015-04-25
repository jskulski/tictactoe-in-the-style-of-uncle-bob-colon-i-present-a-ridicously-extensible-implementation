<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/', function() use ($app) {
  $template = new League\Plates\Engine('templates');
//  $stateRenderer = new \JSK\TicTacToe\StaticWeb\StateRenderer();
  $state = new \JSK\TicTacToe\Game\State();
  $board = new Board($state->getMoveHistory());
  $html = $template->render('board', array(
    'topLeft' => $board->topLeft()->isX() ? $this->render('markerForX') :
                 $board->topLeft()->isO() ? $this->render('markerForO') :
                 $this->render('emptySquare')
  ));
  echo $html;
});

$app->run();

