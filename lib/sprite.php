<?php
class Sprite {
  public $c = [0,0];
  protected $tickFn;

  public function __construct(Array $c, Callable $tickFn){
    $this->c = $c;
    $this->tickFn = $tickFn->bindTo($this); 
  }

  public function slideXLeft($x, $step = 2){
    if ($this->c[0] > $x){
      $this->c[0] -= $step;
      return false;
    } 

    $this->c[0] = $x;
    return true;
  }

  public function slideYUp($y, $step = 2){
    if ($this->c[1] > $y){
      $this->c[1] -= $step;
      return false;
    }

    $this->c[1] = $y;
    return true;
  }

  public function slideTo($c, $step = 2){
    list($x, $y)   = $this->c;
    list($tX, $tY) = $c;

    if ($x == $tX && $y == $tY){
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
