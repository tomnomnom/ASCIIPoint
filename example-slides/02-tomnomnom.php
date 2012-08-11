<?php
include __DIR__.'/../lib/bootstrap.php';

$alpha = include __DIR__.'/../lib/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$heading = new Actor([23,-6], function($screen) use($alpha){
  $this->slideY(1,1);
  $screen->spriteWord($this->c, 'TomNomNom', $alpha);
});
$screen->attachActor($heading);


$bio = new Actor([100,9], function($screen){
  static $targetText = null;
  static $displayText;

  if (is_null($targetText)){
    $targetText = str_split(
      "- DevOps Engineer\n".
      "- PHP Hacker\n".
      "- Not really a sheep\n"
    );
  }

  $this->slideX(60, 2);

  $displayText .= array_shift($targetText);
  $screen->text($this->c, $displayText, 25);
});

$sheepySprite = Sprite::fromImage(__DIR__."/../images/tomnomnom.jpg", 20);

$sheepy = new Actor([1,30], function($screen) use($sheepySprite, $bio){

  if ($this->slideY(8, 2)){
    $screen->attachActor($bio); 
  }

  $screen->sprite($this->c, $sheepySprite);
});
$screen->attachActor($sheepy);


$border = new Actor([0,0], function($screen){
  $screen->rect($this->c, [100,30], '#');
});
$screen->attachActor($border);

return $screen;

