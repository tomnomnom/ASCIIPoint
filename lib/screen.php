<?php
class Screen {
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

  public function line($start, $finish, $char){
    if ($start[0] == $finish[0]){
      // vert
      $x = $start[0];
      for ($y = $start[1]; $y <  $finish[1]; $y++){
        $this->setPixel([$x, $y], $char);
      }

    } else if ($start[1] == $finish[1]){
      // horiz
      $y = $start[1];
      for ($x = $start[0]; $x <= $finish[0]; $x++){
        $this->setPixel([$x, $y], $char);
      }

    }
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

  public function text($c, $text){
    list($x, $y) = $c;
    $chars = str_split($text);

    foreach ($chars as $char){
      $this->setPixel([$x, $y], $char);
      $x++;
    }
  }

}

