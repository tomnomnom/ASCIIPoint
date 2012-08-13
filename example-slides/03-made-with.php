<?php
include __DIR__.'/../lib/bootstrap.php';

$alpha = include __DIR__.'/../lib/letters.php';

$slide = new Slide(101, 31);
$slide->clear();

$logoSprite = Sprite::fromImage(__DIR__."/../images/php.jpg", 30);
$logo = new Actor(array(7,30), function($slide) use($logoSprite, $bio){
  $this->slideY(8, 2);
  $slide->sprite($this->c, $logoSprite);
});
$slide->attachActor($logo);

$madeWith = new Actor(array(24,-6), function($slide) use($alpha){
  $this->slideY(2,1);
  $slide->spriteWord($this->c, 'Made with', $alpha);
});
$slide->attachActor($madeWith);

$border = new Actor(array(0,0), function($slide){
  $slide->rect($this->c, array(100,30), '*');
});
$slide->attachActor($border);

return $slide;
