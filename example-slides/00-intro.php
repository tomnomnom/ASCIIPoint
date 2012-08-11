<?php
include __DIR__.'/../lib/bootstrap.php';

$alpha = include __DIR__.'/../lib/letters.php';

$slide = new Slide(101, 31);
$slide->clear();

$logoSprite = Sprite::fromImage(__DIR__."/../images/ascii-logo.jpg", 40);
$logo = new Actor([9,30], function($slide) use($logoSprite){
  $this->slideY(2, 2);
  $slide->sprite($this->c, $logoSprite);
});

$slide->attachActor($logo);
$point = new Actor([54,-6], function($slide) use($alpha){
  $this->slideY(14,1);
  $slide->spriteWord($this->c, 'Point', $alpha);
});
$slide->attachActor($point);

$intro = new Actor([54,25], function($slide){
  static $targetText = null;
  static $displayText;

  if (is_null($targetText)){
    $targetText = str_split(
      "An ASCII presentation tool\n".
      "By @ghalfacree and @TomNomNom\n"
    );
  }
  //$this->slideX(60, 2);

  $displayText .= array_shift($targetText);
  $slide->text($this->c, $displayText);
});
$slide->attachActor($intro);

$border = new Actor([0,0], function($slide){
  $slide->rect($this->c, [100,30], '*');
});
$slide->attachActor($border);

return $slide;
