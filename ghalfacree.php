<?php
include __DIR__.'/lib/screen.php';
include __DIR__.'/lib/sprite.php';

$alpha = include __DIR__.'/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$sheepy = array_map(function($line){
  return trim($line, "\n");
}, file(__DIR__."/images/ghalfacree.jpg.txt"));

$textTest = new Sprite([60,10], function($screen){
  $screen->text($this->c, 'I am some text');
});

$sheepySprite = new Sprite([50,40], function($screen) use($sheepy,$textTest){
  if ($this->slideYUp(2)){
    if ($this->slideXLeft(5)){
      $screen->attachSpriteObject($textTest);
    }
  }
  $screen->sprite($this->c, $sheepy);
});
$screen->attachSpriteObject($sheepySprite);

$border = new Sprite([0,0], function($screen){
  $screen->rect($this->c, [100,30], '#');
});
$screen->attachSpriteObject($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


