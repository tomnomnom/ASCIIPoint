<?php
include __DIR__.'/lib/screen.php';
include __DIR__.'/lib/actor.php';

$alpha = include __DIR__.'/lib/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$sheepy = array_map(function($line){
  return trim($line, "\n");
}, file(__DIR__."/images/ghalfacree.jpg.txt"));

$textTest = new Actor([60,10], function($screen){
  $screen->text($this->c, 'I am some text');
});

$sheepySprite = new Actor([50,40], function($screen) use($sheepy,$textTest){
  if ($this->slideY(2)){
    if ($this->slideX(5)){
      $screen->attachActor($textTest);
    }
  }
  $screen->sprite($this->c, $sheepy);
});
$screen->attachActor($sheepySprite);

$border = new Actor([0,0], function($screen){
  $screen->rect($this->c, [100,30], '#');
});
$screen->attachActor($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


