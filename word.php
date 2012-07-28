<?php
include __DIR__.'/lib/screen.php';
$alpha = include __DIR__.'/letters.php';

$screen = new Screen(101, 31);
$screen->clear();

$screen->line([0,0],   [100,0],  '#'); // Top border
$screen->line([0,30],  [100,30], '#'); // Bottom border
$screen->line([0,0],   [0,30],   '#'); // Left border
$screen->line([100,0], [100,30], '#'); // Right border

$screen->spriteWord([5,3], 'HELLO', $alpha);

$screen->drawFrame();

