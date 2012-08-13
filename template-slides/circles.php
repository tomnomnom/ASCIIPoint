<?php
// Bootstrap the ASCIIPoint library
include __DIR__.'/../lib/bootstrap.php';

// Create a new slide
$slide = new Slide(101, 31);

// Create an "Actor" that displays some "random" circles.
// "[0,0]" is the initial coordinates of the Actor,
// but we don't care what they are in this example.
$circles = new Actor(array(0,0), function($actor, $slide){

  // Draw a circle at [10,10] with radius 7 using the '*' character 
  $slide->circle(array(10,10), 7, '*');

  $slide->circle(array(26,10), 7, '*');
  $slide->circle(array(42,10), 7, '*');

  $slide->circle(array(18,17), 7, '*');
  $slide->circle(array(34,17), 7, '*');

});

// Attach the actor to the slide so that it is displayed
$slide->attachActor($circles);

// Remember to return the Slide object so the presenter script can use it.
return $slide;
