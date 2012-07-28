<?php
class Sprite {
  public $c = [0,0];
  protected $tickFn;

  public function __construct(Array $c, Callable $tickFn){
    $this->c = $c;
    $this->tickFn = $tickFn->bindTo($this); 
  }

  public function slideX($x, $step = 2){
    if ($this->c[0] > $x){
      $this->c[0] -= $step;
    } else {
      $this->c[0] = $x;
    }
  }

  public function tick($screen){
    $tickFn = $this->tickFn;
    $tickFn($screen);
  }
}
