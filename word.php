<?php
include __DIR__.'/lib/screen.php';
include __DIR__.'/lib/sprite.php';

$alpha = include __DIR__.'/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$helloWorld = new Sprite([100, 5], function($screen) use($alpha){
  if ($this->c[0] > 6){
    $this->c[0]--;
  }
  $screen->spriteWord($this->c, 'Hello, world!', $alpha);
});

$border = new Sprite([0,0], function($screen){
  $screen->rect($this->c, [100,30], '#');
});

$screen->attachSpriteObject($helloWorld);
$screen->attachSpriteObject($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(25000);
}


