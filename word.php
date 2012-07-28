<?php
include __DIR__.'/lib/screen.php';
$alpha = include __DIR__.'/letters.php';

$screen = new Screen(100, 30);
$screen->clear();

$screen->line([0,0],   [100,0],  '═'); // Top border
$screen->line([0,30],  [100,30], '═'); // Bottom border
$screen->line([0,0],   [0,30],   '║'); // Left border
$screen->line([100,0], [100,30], '║'); // Right border

$screen->setPixel([0,0],    '╔'); // Top left corner
$screen->setPixel([0,30],   '╚'); // Bottom left corner
$screen->setPixel([100,0],  '╗'); // Top right corner
$screen->setPixel([100,30], '╝'); // Bottom right corner

$screen->sprite([5,5], $alpha['A']);

$screen->setPixel([15,15], '▮');
$screen->setPixel([16,15], ' ');
$screen->setPixel([17,15], ' ');
$screen->setPixel([18,15], '▮');

$screen->drawFrame();
