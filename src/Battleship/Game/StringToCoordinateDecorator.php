<?php


namespace JSK\Battleship\Game;


use Notoj\Annotation\Annotation;
use Notoj\Annotation\Annotations;
use Notoj\ReflectionClass;

class StringToCoordinateDecorator {

  /** @var  ??? */
  private $decorated;

  function __construct($decorated)
  {
    $this->decorated = $decorated;
  }

  public function __call($functionName, $arguments) {

    $decoratedClass = get_class($this->decorated);
    $reflectedDecorated = new ReflectionClass($decoratedClass);
    /** @var Annotations $annotations */
    $annotations = $reflectedDecorated->getMethod($functionName)->getAnnotations();
    /** @var Annotation $shouldConvert */
    $shouldConvert = $annotations->getOne('ConvertArgumentToCoordinate');

    if ($shouldConvert) {
      $args = $shouldConvert->getArgs();
      if ($args) {
        $shouldConvert = $args;
      }
      else {
        $shouldConvert = array(true);
      }
    }

    $decoratedArguments = array();
    foreach ($arguments as $index => $argument) {
      $stringCoordinate = $argument;

      if ($shouldConvert[$index]) {
        $decoratedArguments[] = new Coordinate($stringCoordinate);
      } else {
        $decoratedArguments[] = $stringCoordinate;
      }
    }

    return call_user_func_array(
      array($this->decorated, $functionName),
      $decoratedArguments
    );
  }

}

