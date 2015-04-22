<?php


namespace JSK\TicTacToe\StaticWeb;


use JSK\TicTacToe\Game\State;

class StateRendererTest extends \PHPUnit_Framework_TestCase {

  public function test_create_new_object()
  {
    $target = new StateRenderer(new TemplateSpy());
  }

  public function test_given_state_without_moves_renders_empty_board()
  {
    $target = new StateRenderer(new TemplateSpy());
    $rendered = $target->render(new State());
    $this->assertEquals('---\n---\n---', $rendered);
  }

  public function test_given_a_template_renderer_calls_render_on_template()
  {
    $templateSpy = new TemplateSpy();
    $target = new StateRenderer($templateSpy);
    $rendered = $target->render(new State());
    $this->assertTrue($templateSpy->rendered);
  }



//  public function test_give_state_without_moves_renders_custom_board()
//  {
//    $magicKey = 'this is my custom board';
//    $target = new StateRenderer(new CustomTemplateStub($magicKey));
//    $rendered = $target->render(new State());
//    $this->assertEquals($magicKey, $rendered);
//  }

}

class TemplateSpy {
  public $rendered = false;

  public function render()
  {
    $this->rendered = true;
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
    return $magicKey;
  }
}

