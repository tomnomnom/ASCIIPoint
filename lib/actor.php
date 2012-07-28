<?php
class Actor {
  public $c = [0,0];
  protected $tickFn;

  public function __construct(Array $c, Callable $tickFn){
    $this->c = $c;
    $this->tickFn = $tickFn->bindTo($this); 
  }

  public function slideX($tX, $step = 2){
    list($x, $y) = $this->c;

    if ($x == $tX){
      // Animation finished
      return true;
    }

    if ($x < $tX){
      $x += $step;
    }
    if ($x > $tX){
      $x -= $step;
    }

    // Lock to final location if close enough
    if (abs($x - $tX) < $step){
      $x = $tX;
    }

    $this->c = [$x, $y];

    return false;
  }

  public function slideY($tY, $step = 2){
    list($x, $y)   = $this->c;

    if ($y == $tY){
      // Animation finished
      return true;
    }

    if ($y < $tY){
      $y += $step;
    }
    if ($y > $tY){
      $y -= $step;
    }

    // Lock to final location if close enough
    if (abs($y - $tY) < $step){
      $y = $tY;
    }

    $this->c = [$x, $y];

    return false;
  }

  public function tick($screen){
    $tickFn = $this->tickFn;
    $tickFn($screen);
  }
}
