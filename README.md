# ASCIIPoint

An ASCII presentation tool by Gareth Halfacree and Tom Hudson. 
Written in less than 24 hours for LeedsHack 2012.

## Requirements 
* linux
* PHP 5.4
* jp2a

## Instructions
Run `./present.php example-slides/*` to see the example slides. Advance slides with
Enter.

If you receive the error `./present.php: Permission denied`: you may need to set the present
script to be executable using `chmod +x present.php`.

To run a single slide (e.g. one of the template slides), just pass the filename as the only argument:

    ./present.php template-slides/lines.php 

## Demo
A screencast can be seen here: http://www.youtube.com/watch?v=9wPgShYsN2Y

A live demo at LeedsHack 2012 can be seen here: http://www.youtube.com/watch?v=3fR9q6tfaFQ
