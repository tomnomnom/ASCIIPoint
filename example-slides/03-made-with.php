<?php
include __DIR__.'/../lib/bootstrap.php';

$alpha = include __DIR__.'/../lib/letters.php';

$slide = new Slide(101, 31);
$slide->clear();

$logoSprite = Sprite::fromImage(__DIR__."/../images/php.jpg", 30);
$logo = new Actor(array(7,30), function($actor, $slide) use($logoSprite, $bio){
  $actor->slideY(8, 2);
  $slide->sprite($actor->c, $logoSprite);
});
$slide->attachActor($logo);

$madeWith = new Actor(array(24,-6), function($actor, $slide) use($alpha){
  $actor->slideY(2,1);
  $slide->spriteWord($actor->c, 'Made with', $alpha);
});
$slide->attachActor($madeWith);

$border = new Actor(array(0,0), function($actor, $slide){
  $slide->rect($actor->c, array(100,30), '*');
});
$slide->attachActor($border);

return $slide;
