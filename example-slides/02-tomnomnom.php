<?php
include __DIR__.'/../lib/bootstrap.php';

$alpha = include __DIR__.'/../lib/letters.php';

$slide = new Slide(101, 31);
$slide->clear();

$heading = new Actor(array(23,-6), function($actor, $slide) use($alpha){
  $actor->slideY(1,1);
  $slide->spriteWord($actor->c, 'TomNomNom', $alpha);
});
$slide->attachActor($heading);


$bio = new Actor(array(100,9), function($actor, $slide){
  static $targetText = null;
  static $displayText;

  if (is_null($targetText)){
    $targetText = str_split(
      "- DevOps Engineer\n".
      "- PHP Hacker\n".
      "- Not really a sheep\n"
    );
  }

  $actor->slideX(60, 2);

  $displayText .= array_shift($targetText);
  $slide->text($actor->c, $displayText, 25);
});

$sheepySprite = Sprite::fromImage(__DIR__."/../images/tomnomnom.jpg", 20);

$sheepy = new Actor(array(1,30), function($actor, $slide) use($sheepySprite, $bio){

  if ($actor->slideY(8, 2)){
    $slide->attachActor($bio); 
  }

  $slide->sprite($actor->c, $sheepySprite);
});
$slide->attachActor($sheepy);


$border = new Actor(array(0,0), function($actor, $slide){
  $slide->rect($actor->c, array(100,30), '#');
});
$slide->attachActor($border);

return $slide;

