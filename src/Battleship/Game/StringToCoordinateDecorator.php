<?php


namespace JSK\Battleship\Game;


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
    $shouldConvert = $annotations->has('ConvertToCoordinate');

    $stringCoordinate = $arguments[0];

    if ($shouldConvert) {
      $coordinate = new Coordinate($stringCoordinate);
    } else {
      $coordinate = $stringCoordinate;
    }

    return $this->decorated->$functionName($coordinate);
  }

}

