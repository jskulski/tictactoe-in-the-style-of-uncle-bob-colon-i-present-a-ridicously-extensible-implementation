<?php


namespace JSK\Battleship\Game;


class StringToCoordinateDecoratorTest extends \PHPUnit_Framework_TestCase {

  public function test_decorator_invokes_decorated()
  {
    $stub = new Stub();
    $decoratedObject = new StringToCoordinateDecorator($stub);
    $coordinate = $decoratedObject->testDecorator('A4');
    $this->assertTrue($stub->wasCalled);
  }

  public function test_decorator_converts_string_to_coordinate_in_function_call()
  {
    $stub = new Stub();
    $decoratedObject = new StringToCoordinateDecorator($stub);
    $coordinate = $decoratedObject->testDecorator('A4');
    $this->assertInstanceOf(Coordinate::class, $coordinate);
  }

  public function test_decorator_is_not_invoked_on_functions_without_annotation()
  {
    $stub = new Stub();
    $decoratedObject = new StringToCoordinateDecorator($stub);
    $string = $decoratedObject->testNotDecorated('A4');
    $this->assertEquals('A4', $string);
  }

}

class Stub {

  /** @var  boolean */
  public $wasCalled = false;

  /**
   * @ConvertToCoordinate
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

}
