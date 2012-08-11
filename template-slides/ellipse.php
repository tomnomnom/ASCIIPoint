<?php
// Bootstrap the ASCIIPoint library
include __DIR__.'/../lib/bootstrap.php';

// Create a new slide
$slide = new Slide(101, 31);

// Create an "Actor" that displays an ellipse
// "[0,0]" is the initial coordinates of the Actor,
// but we don't care what they are in this example.
$ellipse = new Actor([0,0], function($slide){

  // Draw an ellipse inside the rectangle [10,10] [40,20] using the '#' character
  $slide->ellipse([10,10], [40,20], '#');

});

// Attach the actor to the slide so that it is displayed
$slide->attachActor($ellipse);

// Remember to return the Slide object so the presenter script can use it.
return $slide;
