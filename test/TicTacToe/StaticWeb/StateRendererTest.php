<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\Move;
use JSK\TicTacToe\Game\PlayerMove;
use JSK\TicTacToe\Game\State;

class StateRendererTest extends \PHPUnit_Framework_TestCase {

  public function test_create_new_object()
  {
    $target = new StateRenderer(new TemplateStub());
  }

  public function test_given_state_without_moves_renders_empty_board()
  {
    $target = new StateRenderer(new TemplateStub());
    $rendered = $target->render(new State());
    $this->assertEquals('---\n---\n---', $rendered);
  }

  public function test_given_a_template_renderer_calls_render_on_template()
  {
    $templateSpy = new TemplateStub();
    $target = new StateRenderer($templateSpy);
    $rendered = $target->render(new State());
    $this->assertTrue($templateSpy->rendered);
  }

  public function test_given_state_without_moves_renders_custom_board()
  {
    $magicKey = 'this is my custom board';
    $target = new StateRenderer(new CustomTemplateStub($magicKey));
    $rendered = $target->render(new State());
    $this->assertEquals($magicKey, $rendered);
  }

  public function test_given_state_with_move_in_center_renders_mark_in_center()
  {
    $state = new State();
    $state->addMoveToMoveHistory(
      PlayerMove::forX(0,0)
    );
    $target = new StateRenderer(new TemplateStub());
    $rendered = $target->render($state);
    $this->assertEquals('---\n-X-\n---', $rendered);
  }

  public function test_given_state_with_move_in_top_right_renders_mark_in_top_right()
  {
    $state = new State();
    $state->addMoveToMoveHistory(
      PlayerMove::forX(-1, -1)
    );
    $target = new StateRenderer(new TemplateStub());
    $rendered = $target->render($state);
    $this->assertEquals('X--\n---\n---', $rendered);
  }


}

class TemplateStub {
  public $rendered = false;

  /**
   * @return string
   */
  public function render(State $state)
  {
    $this->rendered = true;
    $moveHistory = $state->getMoveHistory();
    $boardArray = $this->buildBoardArrayFromMoveHistory($moveHistory);
    return implode($boardArray);
  }

  /**
   * @param $moveHistory
   * @return array
   */
  private function buildBoardArrayFromMoveHistory($moveHistory)
  {
    $boardArray = array(
      '-', '-', '-', '\n',
      '-', '-', '-', '\n',
      '-', '-', '-'
    );

    /** @var Move $move */
    foreach ($moveHistory as $move) {
      if ($move->getRow() == 0 && $move->getColumn() == 0) {
        $boardArray[5] = 'X';
      } else {
        $boardArray[0] = 'X';
      }
    }
    return $boardArray;
  }
}

class CustomTemplateStub {
  /** @var  string */
  private $magicKey;

  function __construct($magicKey)
  {
    $this->magicKey = $magicKey;
  }

  public function render()
  {
    return $this->magicKey;
  }
}

