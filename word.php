<?php
include __DIR__.'/lib/screen.php';
$alpha = include __DIR__.'/letters.php';

$screen = new Screen(100, 30);
$screen->clear();

$screen->line([0,0],   [100,0],  '#'); // Top border
$screen->line([0,30],  [100,30], '#'); // Bottom border
$screen->line([0,0],   [0,30],   '#'); // Left border
$screen->line([100,0], [100,30], '#'); // Right border

$screen->sprite([5,5], $alpha['A']);
$screen->sprite([11,5], $alpha['B']);
$screen->sprite([17,5], $alpha['C']);

$screen->drawFrame();

