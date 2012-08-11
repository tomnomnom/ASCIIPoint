#!/usr/bin/env php
<?php
// ASCIIPoint runner script

define('FRAME_USLEEP', 65000);

if ($argc < 2){
  echo "You must specify at least one slide.\n";
  exit(1);
}

$cmdName = array_shift($argv);

$slides = [];

// Remaining arguments are slides
foreach ($argv as $slide){
  $slide = new SplFileInfo($slide);
  if (!$slide->isReadable()) continue;

  $slides[] = include $slide;
}

$stdin = fopen('php://stdin', 'r');

stream_set_blocking($stdin, 0);

foreach ($slides as $slide){
  $slide = array_shift($slides);
  do {
    $slide->tick();
    usleep(FRAME_USLEEP);
    $in = fgets($stdin);
  } while (!$in);
}
