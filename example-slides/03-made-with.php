<?php
include __DIR__.'/../lib/screen.php';
include __DIR__.'/../lib/actor.php';
include __DIR__.'/../lib/sprite.php';

$alpha = include __DIR__.'/../lib/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$logoSprite = Sprite::fromImage(__DIR__."/../images/php.jpg", 30);
$logo = new Actor([7,30], function($screen) use($logoSprite, $bio){
  $this->slideY(8, 2);
  $screen->sprite($this->c, $logoSprite);
});
$screen->attachActor($logo);

$madeWith = new Actor([24,-6], function($screen) use($alpha){
  $this->slideY(2,1);
  $screen->spriteWord($this->c, 'Made with', $alpha);
});
$screen->attachActor($madeWith);

$border = new Actor([0,0], function($screen){
  $screen->rect($this->c, [100,30], '*');
});
$screen->attachActor($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


