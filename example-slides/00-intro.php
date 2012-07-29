<?php
include __DIR__.'/../lib/screen.php';
include __DIR__.'/../lib/actor.php';
include __DIR__.'/../lib/sprite.php';

$alpha = include __DIR__.'/../lib/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$logoSprite = Sprite::fromImage(__DIR__."/../images/ascii-logo.jpg", 40);
$logo = new Actor([9,30], function($screen) use($logoSprite, $bio){
  $this->slideY(2, 2);
  $screen->sprite($this->c, $logoSprite);
});

$screen->attachActor($logo);
$point = new Actor([54,-6], function($screen) use($alpha){
  $this->slideY(14,1);
  $screen->spriteWord($this->c, 'Point', $alpha);
});
$screen->attachActor($point);

$intro = new Actor([54,25], function($screen){
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
  $screen->text($this->c, $displayText);
});
$screen->attachActor($intro);

$border = new Actor([0,0], function($screen){
  $screen->rect($this->c, [100,30], '*');
});
$screen->attachActor($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


