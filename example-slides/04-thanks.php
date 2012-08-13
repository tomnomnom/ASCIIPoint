<?php
include __DIR__.'/../lib/bootstrap.php';

$alpha = include __DIR__.'/../lib/letters.php';

$slide = new Slide(101, 31);
$slide->clear();

$logoSprite = Sprite::fromImage(__DIR__."/../images/thumbs-up.jpg", 30);
$logo = new Actor(array(7,30), function($actor, $slide) use($logoSprite, $bio){
  $actor->slideY(1, 2);
  $slide->sprite($actor->c, $logoSprite);
});
$slide->attachActor($logo);

$thanks = new Actor(array(55,-6), function($actor, $slide) use($alpha){
  $actor->slideY(2,1);
  $slide->spriteWord($actor->c, 'Thanks!', $alpha);
});
$slide->attachActor($thanks);

$mainText = new Actor(array(56,31), function($actor, $slide) use($alpha){
  $actor->slideY(10,1);
  $slide->text($actor->c, 'Thanks to the LeedsHack staff, Leeds City Museum, and all the rest of you!', 40);
});
$slide->attachActor($mainText);

$border = new Actor(array(0,0), function($actor, $slide){
  $slide->rect($actor->c, array(100,30), '*');
});
$slide->attachActor($border);


return $slide;
