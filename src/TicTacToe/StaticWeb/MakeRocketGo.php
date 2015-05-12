<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\MoveFilterer;
use JSK\TicTacToe\Game\NullMove;
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
    $stateRepository = $factory->createStateRepository();
    $state = $stateRepository->retrieveById($stateId);
    $move = $this->convertMoveNameParameterToMove($moveName);
    $state->addMoveToMoveHistory($move);
    $stateRepository->save($state);
  }

  /**
   * @param $moveName
   * @return \JSK\TicTacToe\Game\PlayerMove
   */
  private function convertMoveNameParameterToMove($moveName)
  {
    switch ($moveName) {
      case 'topLeft':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(-1, -1);
        break;
      case 'topMiddle':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(-1, 0);
        break;
      case 'topRight':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(-1, 1);
        break;

      case 'middleLeft':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(0, -1);
        break;
      case 'middleMiddle':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(0, 0);
        break;
      case 'middleRight':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(0, 1);
        break;

      case 'bottomLeft':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(1, -1);
        break;
      case 'bottomMiddle':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(1, 0);
        break;
      case 'bottomRight':
        $move = \JSK\TicTacToe\Game\PlayerMove::forX(1, 1);
        break;
      default:
        $move = new NullMove();
        break;
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
