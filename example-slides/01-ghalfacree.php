<?php
include __DIR__.'/../lib/bootstrap.php';

$alpha = include __DIR__.'/../lib/letters.php';

$slide = new Slide(101, 31);
$slide->clear();

$heading = new Actor([23,-6], function($slide) use($alpha){
  $this->slideY(1,1);
  $slide->spriteWord($this->c, 'ghalfacree', $alpha);
});
$slide->attachActor($heading);


$bio = new Actor([100,16], function($slide){
  static $targetText = null;
  static $displayText;

  if (is_null($targetText)){
    $targetText = str_split(
      "- Journalist and author\n".
      "- Erstwhile sysadmin\n".
      "- Insert Kickstart disk\n"
    );
  }

  $this->slideX(60, 2);

  $displayText .= array_shift($targetText);
  $slide->text($this->c, $displayText, 25);
});


$ghalfacreeSprite = Sprite::fromImage(__DIR__."/../images/ghalfacree.jpg", 20);

$ghalfacree = new Actor([1,30], function($slide) use($ghalfacreeSprite, $bio){

  if ($this->slideY(8, 2)){
    $slide->attachActor($bio); 
  }

  $slide->sprite($this->c, $ghalfacreeSprite);
});
$slide->attachActor($ghalfacree);


$border = new Actor([0,0], function($slide){
  $slide->rect($this->c, [100,30], '#');
});
$slide->attachActor($border);

return $slide;


