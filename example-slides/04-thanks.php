<?php
include __DIR__.'/../lib/screen.php';
include __DIR__.'/../lib/actor.php';
include __DIR__.'/../lib/sprite.php';

$alpha = include __DIR__.'/../lib/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$logoSprite = Sprite::fromImage(__DIR__."/../images/thumbs-up.jpg", 30);
$logo = new Actor([7,30], function($screen) use($logoSprite, $bio){
  $this->slideY(1, 2);
  $screen->sprite($this->c, $logoSprite);
});
$screen->attachActor($logo);

$thanks = new Actor([55,-6], function($screen) use($alpha){
  $this->slideY(2,1);
  $screen->spriteWord($this->c, 'Thanks!', $alpha);
});
$screen->attachActor($thanks);

$mainText = new Actor([56,31], function($screen) use($alpha){
  $this->slideY(10,1);
  $screen->text($this->c, 'Thanks to the LeedsHack staff, Leeds City Museum, and all the rest of you!', 40);
});
$screen->attachActor($mainText);

$border = new Actor([0,0], function($screen){
  $screen->rect($this->c, [100,30], '*');
});
$screen->attachActor($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


