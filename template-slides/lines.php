<?php
// Bootstrap the ASCIIPoint library
include __DIR__.'/../lib/bootstrap.php';

// Create a new slide
$slide = new Slide(101, 31);

// Create an "Actor" that displays a triangle.
// "[0,0]" is the initial coordinates of the Actor, 
// but we don't care what they are in this example.
$triangle = new Actor([0,0], function($slide){

  // Draw a line from [5,5] to [55,55] using the '#' character 
  $slide->line([5,5], [55,5], '#');

  $slide->line([5,5], [30,25], '#');

  $slide->line([30,25], [55,5], '#');

});

// Attach the actor to the slide so that it is displayed
$slide->attachActor($triangle);

// Remember to return the Slide object so the presenter 
return $slide;
