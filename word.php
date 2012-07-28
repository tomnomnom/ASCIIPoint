<?php
include __DIR__.'/lib/screen.php';
include __DIR__.'/lib/sprite.php';

$alpha = include __DIR__.'/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$helloWorld = new Sprite(function($screen) use($alpha){
  $screen->spriteWord([3,3], 'Hello, world!', $alpha);
});

$screen->attachSpriteObject($helloWorld);

$screen->clear();

//$screen->spriteWord([5,9], '0123456789', $alpha);

$screen->rect([0,0], [100,30], '#');
$screen->drawFrame();


