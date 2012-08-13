<?php
include __DIR__.'/../lib/bootstrap.php';

$alpha = include __DIR__.'/../lib/letters.php';

$slide = new Slide(101, 31);
$slide->clear();

$logoSprite = Sprite::fromImage(__DIR__."/../images/ascii-logo.jpg", 40);
$logo = new Actor(array(9,30), function($actor, $slide) use($logoSprite){
  $actor->slideY(2, 2);
  $slide->sprite($actor->c, $logoSprite);
});

$slide->attachActor($logo);
$point = new Actor(array(54,-6), function($actor, $slide) use($alpha){
  $actor->slideY(14,1);
  $slide->spriteWord($actor->c, 'Point', $alpha);
});
$slide->attachActor($point);

$intro = new Actor(array(54,25), function($actor, $slide){
  static $targetText = null;
  static $displayText;

  if (is_null($targetText)){
    $targetText = str_split(
      "An ASCII presentation tool\n".
      "By @ghalfacree and @TomNomNom\n"
    );
  }
  //$actor->slideX(60, 2);

  $displayText .= array_shift($targetText);
  $slide->text($actor->c, $displayText);
});
$slide->attachActor($intro);

$border = new Actor(array(0,0), function($actor, $slide){
  $slide->rect($actor->c, array(100,30), '*');
});
$slide->attachActor($border);

return $slide;
