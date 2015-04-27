<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\Move;
use JSK\TicTacToe\Game\NullMove;
use JSK\TicTacToe\Game\PlayerMove;
use League\Plates\Engine;


class StateRendererTest extends \PHPUnit_Framework_TestCase
{

  const X = 'X';
  const O = 'O';
  const emptySpace = '-';

  /** @var  StateRenderer */
  private $target;
  /** @var TemplateStub */
  private $templateStub;

  /**
   * @return StateRenderer
   */
  public function setUp()
  {
    $this->templateStub = new TemplateStub();
    $this->templateStub->setPlayerXMarker(self::X);
    $this->templateStub->setPlayerOMarker(self::O);
    $this->target = new StateRenderer($this->templateStub);
  }

//  public function test_given_a_template_renderer_calls_render_on_template()
//  {
//    $rendered = $this->target->render(new State());
//    $this->assertTrue($this->templateStub->rendered);
//  }
//
//  public function test_given_state_without_moves_renders_custom_board()
//  {
//    $magicKey = 'this is my custom board';
//    $target = new StateRenderer(new CustomTemplateStub($magicKey));
//    $rendered = $target->render(new State());
//    $this->assertEquals($magicKey, $rendered);
//  }

//  public function test_given_state_without_moves_renders_empty_board()
//  {
//    $rendered = $this->target->render(new State());
//    $this->assertEquals('---\n---\n---', $rendered);
//  }
//
//  public function test_given_state_with_move_in_center_renders_mark_in_center()
//  {
//    $state = new State();
//    $state->addMoveToMoveHistory(
//      PlayerMove::forX(0, 0)
//    );
//    $rendered = $this->target->render($state);
//    $this->assertEquals('---\n-X-\n---', $rendered);
//  }
//
//  public function test_given_state_with_move_in_top_right_renders_mark_in_top_right()
//  {
//    $state = new State();
//    $state->addMoveToMoveHistory(
//      PlayerMove::forX(-1, -1)
//    );
//    $rendered = $this->target->render($state);
//    $this->assertEquals('X--\n---\n---', $rendered);
//  }

  public function test_given_a_move_for_player_one_state_renderer_renders_our_X_template()
  {
    /** @var Move $move */
    $move = PlayerMove::forX(-1, -1);
    $this->assertEquals(self::X, $this->target->renderMove($move));
  }

  public function test_given_a_move_for_player_two_state_renderer_renders_our_O_template()
  {
    /** @var Move $move */
    $move = PlayerMove::forO(-1, -1);
    $this->assertEquals(self::O, $this->target->renderMove($move));
  }

  public function test_given_a_null_move_renderer_renders_empty_space()
  {
    /** @var Move $move */
    $move = new NullMove();
    $this->assertEquals(self::emptySpace, $this->target->renderMove($move));
  }


}

class Board
{

  /** @var  Move[] */
  private $moveHistory;

  function __construct($moveHistory)
  {
    $this->moveHistory = $moveHistory;
  }

}

class TemplateStub extends Engine
{

  const EmptyMarker = '-';
  private $playerXMarker;
  private $playerOMarker;

  public $rendered = false;


  public function setPlayerXMarker($playerXMarker)
  {
    $this->playerXMarker = $playerXMarker;
  }

  public function setPlayerOMarker($playerOMarker)
  {
    $this->playerOMarker = $playerOMarker;
  }

  public function render($name, array $data = array())
  {
    switch ($name) {
      case 'X':
        return $this->playerXMarker;
      case 'O':
        return $this->playerOMarker;
      case 'emptySpace':
        return self::EmptyMarker;
    }
  }
//  /**
//   * @return string
//   */
//  public function render(State $state)
//  {
//    $this->rendered = true;
//    $moveHistory = $state->getMoveHistory();
//    $this->board = new Board($moveHistory);
//    $boardArray = $this->buildBoardArrayFromMoveHistory($moveHistory);
//    return implode(array(
//      $boardArray[0], $boardArray[1], $boardArray[2], '\n',
//      $boardArray[3], $boardArray[4], $boardArray[5], '\n',
//      $boardArray[6], $boardArray[7], $boardArray[8]
//    ));
//  }
//
//  /**
//   * @param Move[] $moveHistory
//   * @return array
//   */
//  private function buildBoardArrayFromMoveHistory($moveHistory)
//  {
//    $boardArray = array(
//      self::EmptyMarker, self::EmptyMarker, self::EmptyMarker,
//      self::EmptyMarker, self::EmptyMarker, self::EmptyMarker,
//      self::EmptyMarker, self::EmptyMarker, self::EmptyMarker
//    );
//
//    /** @var Move $move */
//    foreach ($moveHistory as $move) {
//      if ($move->getRow() == 0 && $move->getColumn() == 0) {
//        $boardArray[4] = $this->playerXMarker;
//      } else {
//        $boardArray[0] = $this->playerXMarker;
//      }
//    }
//
//    return $boardArray;
//  }
}

class CustomTemplateStub
{
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

