<?php
include __DIR__.'/lib/screen.php';
include __DIR__.'/lib/actor.php';

$alpha = include __DIR__.'/lib/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$helloWorld = new Actor([100, 5], function($screen) use($alpha){
  $this->slideX(5);
  $screen->spriteWord($this->c, 'Hello, world!', $alpha);
});
$screen->attachActor($helloWorld);

$textTest = new Actor([5,10], function($screen){
  $screen->text($this->c, 'I am some text');
});
$screen->attachActor($textTest);

$border = new Actor([0,0], function($screen){
  $screen->rect($this->c, [100,30], '#');
});
$screen->attachActor($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


