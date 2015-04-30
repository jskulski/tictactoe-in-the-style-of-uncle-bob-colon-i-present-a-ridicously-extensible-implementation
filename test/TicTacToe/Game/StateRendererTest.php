<?php


namespace JSK\TicTacToe\Game;


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
    $this->target = new StateRenderer($this->templateStub, new MoveFilterer());
  }

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

  public function test_given_an_empty_move_history_it_should_render_empty_board()
  {
    $state = new State();
    $moveHistory = $state->getMoveHistory();
    $this->assertEquals("---\n---\n---", $this->target->renderBoard($moveHistory));
  }

  public function test_given_a_move_history_with_one_move_board_is_rendered_with_that_move()
  {
    $moveHistory = array(
      PlayerMove::forX(-1, -1)
    );
    $this->assertEquals("X--\n---\n---", $this->target->renderBoard($moveHistory));
  }

  public function test_given_a_move_history_with_center_move_board_is_rendered_with_just_center_move()
  {
    $moveHistory = array(
      PlayerMove::forX(0, 0)
    );
    $this->assertEquals("---\n-X-\n---", $this->target->renderBoard($moveHistory));
  }
//  public function given_an_cats_game_render_board_renders_all_moves()
//  {
//    
//$catsGameMoveHistory = array(
//PlayerMove::forX(-1, -1),
//PlayerMove::forO(-1,  0),
//PlayerMove::forX(-1,  1),
//PlayerMove::forO( 0, -1),
//PlayerMove::forX( 0,  1),
//PlayerMove::forO( 0,  0),
//PlayerMove::forX( 1, -1),
//PlayerMove::forO( 1,  1),
//PlayerMove::forO( 1,  0)
//);
//
//  }

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
      case 'move':
        /** @var Move $move */
        $move = $data['move'];
        if ($move->isX()) {
          $rendered =  $this->playerXMarker;
        }
        elseif ($move->isO()) {
          $rendered =  $this->playerOMarker;
        }
        elseif ($move->isNullObject()) {
          $rendered =  self::EmptyMarker;
        }
        break;

      case 'X':
        $rendered = $this->playerXMarker;
        break;

      case 'O':
        $rendered = $this->playerOMarker;
        break;

      case 'emptySpace':
        $rendered = self::EmptyMarker;
        break;

      case 'board':
        $rendered =  $this->renderBoard(
          $data['topLeft'],
          $data['topMiddle'],
          $data['topRight'],
          $data['middleLeft'],
          $data['middleMiddle'],
          $data['middleRight'],
          $data['bottomLeft'],
          $data['bottomMiddle'],
          $data['bottomRight']
        );
        break;

      default:
        throw new \Exception("Unsupported template");
    }

    return $rendered;
  }

  /**
   * @param Move
   * @param Move
   * @param Move
   * @param Move
   * @param Move
   * @param Move
   * @param Move
   * @param Move
   * @param Move
   * @return string
   */
  private function renderBoard(
    $topLeft, $topMiddle, $topRight,
    $middleLeft, $middleMiddle, $middleRight,
    $bottomLeft, $bottomMiddle, $bottomRight
  )
  {
    $renderedTopLeft = $this->render('move', array('move' => $topLeft));
    $renderedTopMiddle = $this->render('move', array('move' => $topMiddle));
    $renderedTopRight = $this->render('move', array('move' => $topRight));
    $renderedMiddleLeft = $this->render('move', array('move' => $middleLeft));
    $renderedMiddleMiddle = $this->render('move', array('move' => $middleMiddle));
    $renderedMiddleRight = $this->render('move', array('move' => $middleRight));
    $renderedBottomLeft = $this->render('move', array('move' => $bottomLeft));
    $renderedBottomMiddle = $this->render('move', array('move' => $bottomMiddle));
    $renderedBottomRight = $this->render('move', array('move' => $bottomRight));

    return $renderedTopLeft . $renderedTopMiddle . $renderedTopRight ."\n".
           $renderedMiddleLeft . $renderedMiddleMiddle . $renderedMiddleRight ."\n".
           $renderedBottomLeft . $renderedBottomMiddle . $renderedBottomRight;
  }
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

