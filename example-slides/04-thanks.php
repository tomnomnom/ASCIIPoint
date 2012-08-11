<?php
include __DIR__.'/../lib/bootstrap.php';

$alpha = include __DIR__.'/../lib/letters.php';

$slide = new Slide(101, 31);
$slide->clear();

$logoSprite = Sprite::fromImage(__DIR__."/../images/thumbs-up.jpg", 30);
$logo = new Actor([7,30], function($slide) use($logoSprite, $bio){
  $this->slideY(1, 2);
  $slide->sprite($this->c, $logoSprite);
});
$slide->attachActor($logo);

$thanks = new Actor([55,-6], function($slide) use($alpha){
  $this->slideY(2,1);
  $slide->spriteWord($this->c, 'Thanks!', $alpha);
});
$slide->attachActor($thanks);

$mainText = new Actor([56,31], function($slide) use($alpha){
  $this->slideY(10,1);
  $slide->text($this->c, 'Thanks to the LeedsHack staff, Leeds City Museum, and all the rest of you!', 40);
});
$slide->attachActor($mainText);

$border = new Actor([0,0], function($slide){
  $slide->rect($this->c, [100,30], '*');
});
$slide->attachActor($border);


return $slide;
