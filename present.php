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
foreach ($argv as $candidate){
  $candidate = new SplFileInfo($candidate);
  if (!$candidate->isFile()) continue;

  $candidate = include $candidate;
  if ($candidate instanceOf Slide){
    $slides[] = $candidate;
  }
}

if (sizeOf($slides) == 0){
  echo "No valid slides were found.\n";
  echo "Be sure your slide files return the Slide object.\n";
  exit(2);
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
