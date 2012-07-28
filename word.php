<?php
include __DIR__.'/lib/screen.php';
include __DIR__.'/lib/sprite.php';

$alpha = include __DIR__.'/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$helloWorld = new Sprite([100, 5], function($screen) use($alpha){
  $this->slideXLeft(5);
  $screen->spriteWord($this->c, 'Hello, world!', $alpha);
});
$screen->attachSpriteObject($helloWorld);

$textTest = new Sprite([5,10], function($screen){
  $screen->text($this->c, 'I am some text');
});
$screen->attachSpriteObject($textTest);

$border = new Sprite([0,0], function($screen){
  $screen->rect($this->c, [100,30], '#');
});
$screen->attachSpriteObject($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


