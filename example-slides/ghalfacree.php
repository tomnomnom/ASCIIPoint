<?php
include __DIR__.'/../lib/screen.php';
include __DIR__.'/../lib/actor.php';
include __DIR__.'/../lib/sprite.php';

$alpha = include __DIR__.'/../lib/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$heading = new Actor([23,-6], function($screen) use($alpha){
  $this->slideY(1,1);
  $screen->spriteWord($this->c, 'ghalfacree', $alpha);
});
$screen->attachActor($heading);


$bio = new Actor([100,16], function($screen){
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
  $screen->text($this->c, $displayText, 25);
});


$ghalfacreeSprite = Sprite::fromImage(__DIR__."/../images/ghalfacree.jpg", 20);

$ghalfacree = new Actor([1,30], function($screen) use($ghalfacreeSprite, $bio){

  if ($this->slideY(8, 2)){
    $screen->attachActor($bio); 
  }

  $screen->sprite($this->c, $ghalfacreeSprite);
});
$screen->attachActor($ghalfacree);


$border = new Actor([0,0], function($screen){
  $screen->rect($this->c, [100,30], '#');
});
$screen->attachActor($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


