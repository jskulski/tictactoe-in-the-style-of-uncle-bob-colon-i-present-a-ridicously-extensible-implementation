<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\Factory as GameFactory;
use JSK\TicTacToe\Game\Game;
use JSK\TicTacToe\Game\MoveFilterer;
use JSK\TicTacToe\Game\PlayerMove;
use JSK\TicTacToe\Game\State;
use JSK\TicTacToe\Game\StateRenderer;

class MakeRocketGo {

  public function displayList()
  {
    $factory = new Factory();
    $templateEngine = $factory->createTemplateEngine();
    $stateRepository = $factory->createStateRepository();
    $allStates = $stateRepository->retrieveAll();
    $html = $templateEngine->render('list', array('states' => $allStates));
    return $html;
  }

  public function displayState($stateId) {
    $factory = new Factory();
    $templateEngine = $factory->createTemplateEngine();
    $moveFilterer = new MoveFilterer();
    $stateRenderer = new StateRenderer($templateEngine, $moveFilterer);
    $stateRepository = $factory->createStateRepository();

    try {
      $state = $stateRepository->retrieveById($stateId);
      $boardHtml = $stateRenderer->renderBoard($state->getMoveHistory());
      $html = $templateEngine->render(
        'layout', array(
          'stateId' => $stateId,
          'board' => $boardHtml
        )
      );

      $html .= '<form action="/state" method="POST"><button value="New Game">New Game</button></form>';
    }
    catch(\Exception $exception) {
      $html = 'Sorry game not found! Start a new game?';
    }

    return $html;
  }

  public function makeMove($stateId, $moveName) {
    $factory = new Factory();
    $gameFactory = new GameFactory();
    $stateRepository = $factory->createStateRepository();
    $state = $stateRepository->retrieveById($stateId);
    /** @var Game $game */
    $move = $this->convertMoveNameParameterToMove($moveName, $state->isPlayerXTurn());
    $game = $gameFactory->createGame();
    $newState = $game->makeMove($move, $state);
    $stateRepository->save($newState);
  }

  /**
   * @param $moveName
   * @param boolean $isPlayerXTurn
   * @return \JSK\TicTacToe\Game\PlayerMove
   */
  private function convertMoveNameParameterToMove($moveName, $isPlayerXTurn)
  {
    switch ($moveName) {
      case 'topLeft':
        $row = -1;
        $column = -1;;
        break;
      case 'topMiddle':
        $row = -1;
        $column = 0;
        break;
      case 'topRight':
        $row = -1;
        $column = 1;
        break;

      case 'middleLeft':
        $row = 0;
        $column = -1;
        break;
      case 'middleMiddle':
        $row = 0;
        $column = 0;
        break;
      case 'middleRight':
        $row = 0;
        $column = 1;
        break;

      case 'bottomLeft':
        $row = 1;
        $column = -1;
        break;
      case 'bottomMiddle':
        $row = 1;
        $column = 0;
        break;
      case 'bottomRight':
        $row = 1;
        $column = 1;
        break;

      default:
        throw new \Exception("Move name not supported");
        break;
    }

    if ($isPlayerXTurn) {
      $move = PlayerMove::forX($row, $column);
    }
    else {
      $move = PlayerMove::forO($row, $column);
    }


    return $move;
  }

  public function createNewState()
  {
    $factory = new Factory();
    $stateRepository = $factory->createStateRepository();
    $state = new State();
    $stateId = $stateRepository->save($state);
    return $stateId;
  }

}
