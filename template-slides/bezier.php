<?php
// Bootstrap the ASCIIPoint library
include __DIR__.'/../lib/bootstrap.php';

// Create a new slide
$slide = new Slide(101, 31);

// Create an "Actor" that displays a bezier curve.
// "[0,0]" is the initial coordinates of the Actor,
// but we don't care what they are in this example.
$bezier = new Actor([0,0], function($slide){

  // Draw a bezier curve between [0,30] and [100,20], with [48,1] 
  // as the "control point", using the '#' character
  $slide->bezier([0,30], [48,1], [100,20], '#');

});

// Attach the actor to the slide so that it is displayed
$slide->attachActor($bezier);

// Remember to return the Slide object so the presenter script can use it.
return $slide;
