<?php


namespace JSK\Battleship\Game;


class StringToCoordinateDecoratorTest extends \PHPUnit_Framework_TestCase {

  public function test_decorator_invokes_decorated()
  {
    $stub = new Stub();
    /** @var Stub $decoratedObject */
    $decoratedObject = new StringToCoordinateDecorator($stub);
    $decoratedObject->testDecorator('A4');
    $this->assertTrue($stub->wasCalled);
  }

  public function test_decorator_converts_string_to_coordinate_in_function_call()
  {
    $stub = new Stub();
    /** @var Stub $decoratedObject */
    $decoratedObject = new StringToCoordinateDecorator($stub);
    $coordinate = $decoratedObject->testDecorator('A4');
    $this->assertInstanceOf(Coordinate::class, $coordinate);
  }

  public function test_decorator_is_not_invoked_on_functions_without_annotation()
  {
    $stub = new Stub();
    /** @var Stub $decoratedObject */
    $decoratedObject = new StringToCoordinateDecorator($stub);
    $string = $decoratedObject->testNotDecorated('A4');
    $this->assertEquals('A4', $string);
  }

  public function test_decorator_is_invoked_only_on_arguments_specified()
  {
    $stub = new Stub();
    /** @var Stub $decoratedObject */
    $decoratedObject = new StringToCoordinateDecorator($stub);
    $decoratedObject->testArguments('A4', 'A4');

    $this->assertEquals('A4', $stub->calledWith[0]);
    $this->assertInstanceOf(Coordinate::class, $stub->calledWith[1]);
  }

}

class Stub {

  /** @var  boolean */
  public $wasCalled = false;
  /** @var array */
  public $calledWith = array();

  /**
   * @ConvertArgumentToCoordinate
   * @param $coordinate
   * @return mixed
   */
  public function testDecorator($coordinate) {
    $this->wasCalled = true;
    return $coordinate;
  }

  public function testNotDecorated($coordinate) {
    $this->wasCalled = true;
    return $coordinate;
  }

  /**
   * @ConvertArgumentToCoordinate(false, true)
   */
  public function testArguments($arg1, $arg2)
  {
    $this->calledWith = func_get_args();
  }

}
