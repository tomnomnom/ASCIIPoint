<?php
include __DIR__.'/lib/screen.php';
$alpha = include __DIR__.'/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$screen->rect([0,0], [100,30], '#');

$screen->spriteWord([5,3], 'Hello, world!', $alpha);
$screen->spriteWord([5,9], '0123456789', $alpha);

$screen->drawFrame();

