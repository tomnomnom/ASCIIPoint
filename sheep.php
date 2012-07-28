<?php
include __DIR__.'/lib/screen.php';
include __DIR__.'/lib/actor.php';

$alpha = include __DIR__.'/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$sheepy = array_map(function($line){
  return trim($line, "\n");
}, file(__DIR__."/images/tomnomnom.jpg.txt"));

$sheepyActor = new Actor([100,30], function($screen) use($sheepy){
  $this->slideX(2, 3);
  $this->slideY(2, 1);
  $screen->sprite($this->c, $sheepy);
});
$screen->attachActor($sheepyActor);

$border = new Actor([0,0], function($screen){
  $screen->rect($this->c, [100,30], '#');
});
$screen->attachActor($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


