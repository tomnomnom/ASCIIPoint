<?php
class Sprite {
  protected $c = [0,0];
  protected $tickFn;

  public function __construct(Callable $tickFn){
    $this->tickFn = $tickFn->bindTo($this); 
  }

  public function tick($screen){
    $tickFn = $this->tickFn;
    $tickFn($screen);
  }
}
