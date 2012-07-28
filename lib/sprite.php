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
    } else {
      $this->c[0] = $x;
    }
  }

  public function slideYUp($y, $step = 2){
    if ($this->c[1] > $y){
      $this->c[1] -= $step;
    } else {
      $this->c[1] = $y;
    }
  }

  public function tick($screen){
    $tickFn = $this->tickFn;
    $tickFn($screen);
  }
}
