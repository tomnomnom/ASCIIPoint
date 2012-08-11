<?php
class Slide {
  const BLANK_CHAR = ' ';
  const DEFAULT_WIDTH = 160;
  const DEFAULT_HEIGHT = 45;

  protected $width = self::DEFAULT_WIDTH;
  protected $height = self::DEFAULT_HEIGHT;

  protected $matrix = [];
  protected $actors = null;

  public function __construct($width = self::DEFAULT_WIDTH, $height = self::DEFAULT_HEIGHT){
    $this->width  = $width; 
    $this->height = $height; 
    $this->actors = new SplObjectStorage();

    // Initialise the matrix
    $this->clear();
  }

  public function attachActor(Actor $spriteObject){
    $this->actors->attach($spriteObject);
  }

  public function detachActor(Actor $spriteObject){
    $this->actors->detach($spriteObject);
  }

  public function drawFrame(){
    foreach ($this->actors as $actor){
      $actor->tick($this);
    }

    system('clear');
    
    $output = '';
    for ($i = 0; $i < $this->height; $i++){
      for ($j = 0; $j < $this->width; $j++){
        $output .= $this->matrix[$i][$j];
      }
      $output .= PHP_EOL;
    }
    echo $output;
  }

  public function clear(){
    for ($y = 0; $y < $this->height; $y++){
      $this->matrix[$y] = [];
      for ($x = 0; $x < $this->width; $x++){
        $this->matrix[$y][$x] = self::BLANK_CHAR; 
      }
    }
  }

  public function setPixel($c, $char){
    $this->matrix[$c[1]][$c[0]] = $char;
  }

  public function clearPixel($c){
    $this->setPixel($c[0], $c[1], self::BLANK_CHAR);
  }

  // Thanks to http://free.pages.at/easyfilter/bresenham.html
  public function line($start, $finish, $char){
    list($x0, $y0) = $start;
    list($x1, $y1) = $finish;

    $dx = abs($x1 - $x0);
    $sx = ($x0 < $x1)? 1 : -1;

    $dy = -abs($y1 - $y0);
    $sy = ($y0 < $y1)? 1 : -1;

    $err = $dx + $dy;

    while (true){
      $this->setPixel([$x0,$y0], $char);
      if ($x0 == $x1 && $y0 == $y1) break;

      $e2 = 2 * $err;

      if ($e2 >= $dy){
        $err += $dy;
        $x0  += $sx;
      }

      if ($e2 <= $dx){
        $err += $dx;
        $y0  += $sy;
      }
    }

    return true;
  }

  public function sprite($c, $sprite){
    list($x, $y) = $c; 

    foreach ($sprite as $row){
      foreach (str_split($row) as $pixel){
        $this->setPixel([$x, $y], $pixel);
        $x++;
      }
      $x = $c[0]; // Reset the $x coord
      $y++;
    }
  }

  public function spriteWord($c, $word, $alphabet){
    list($x, $y) = $c;
    $chars = str_split(strToUpper($word));

    foreach ($chars as $char){
      if (!isSet($alphabet[$char])) continue;
      $sprite = $alphabet[$char];
      
      $this->sprite([$x, $y], $sprite);
      $x += 6;
    }
  }

  public function rect($c, $size, $char = '#'){
    list($x, $y) = $c;
    list($w, $h) = $size;

    $this->line([$x,    $y],    [$x+$w, $y],    $char); // Top
    $this->line([$x,    $y+$h], [$x+$w, $y+$h], $char); // Bottom
    $this->line([$x,    $y],    [$x,    $y+$h], $char); // Left
    $this->line([$x+$w, $y],    [$x+$w, $y+$h], $char); // Right
  }

  public function text($c, $text, $width = null){
    list($x, $y) = $c;

    if (is_null($width)){
      $width = strlen($text);
    }

    $lines = explode("\n", wordwrap($text, $width, "\n"));

    foreach ($lines as $line){
      $chars = str_split($line);

      foreach ($chars as $char){
        if (!$char) continue;
        $this->setPixel([$x, $y], $char);
        $x++;
      }
      $x = $c[0]; // Reset X
      $y++; // Next line down for the text
    }
  }

  public function tick(){
    $this->clear();
    $this->drawFrame();
  }

}

