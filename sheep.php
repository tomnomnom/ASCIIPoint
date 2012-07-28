<?php
include __DIR__.'/lib/screen.php';
include __DIR__.'/lib/actor.php';

$alpha = include __DIR__.'/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$sheepySprite = array_map(function($line){
  return trim($line, "\n");
}, file(__DIR__."/images/tomnomnom.jpg.txt"));

$bio = new Actor([60,5], function($screen){
  static $targetText = null;
  static $displayText;

  if (is_null($targetText)){
    $targetText = str_split("This is the bio text and it \nis too long to fit on the screen");
  }

  $displayText .= array_shift($targetText);
  $screen->text($this->c, $displayText);
});

$sheepyActor = new Actor([100,30], function($screen) use($sheepySprite, $bio){
  $this->slideY(2, 1);
  $xFinished = $this->slideX(2, 3);
  $screen->sprite($this->c, $sheepySprite);

  if ($xFinished){
    $screen->attachActor($bio); 
  }
});
$screen->attachActor($sheepyActor);

$border = new Actor([0,0], function($screen){
  $screen->rect($this->c, [100,30], '#');
});
$screen->attachActor($border);

while (true){
  $screen->clear();
  $screen->drawFrame();
  usleep(65000);
}


