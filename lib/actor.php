<?php
class Actor {
  public $c = array(0,0);
  protected $tickFn;

  public function __construct(Array $c, Closure $tickFn){
    $this->c = $c;
    $this->tickFn = $tickFn; 
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

    $this->c = array($x, $y);

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

    $this->c = array($x, $y);

    return false;
  }

  public function tick($slide){
    $tickFn = $this->tickFn;
    $tickFn($this, $slide);
  }

  public function typewrite($text){

  }
}
