<?php
class Slide {
  const BLANK_CHAR = ' ';
  const DEFAULT_WIDTH = 160;
  const DEFAULT_HEIGHT = 45;

  const BLACK  = '0;30';
  const RED    = '0;31';
  const GREEN  = '0;32';
  const YELLOW = '0;33';
  const BLUE   = '0;34';
  const PURPLE = '0;35';
  const CYAN   = '0;36';
  const WHITE  = '0;37';

  const BLACK_BOLD  = '1;30';
  const RED_BOLD    = '1;31';
  const GREEN_BOLD  = '1;32';
  const YELLOW_BOLD = '1;33';
  const BLUE_BOLD   = '1;34';
  const PURPLE_BOLD = '1;35';
  const CYAN_BOLD   = '1;36';
  const WHITE_BOLD  = '1;37';

  protected $width = self::DEFAULT_WIDTH;
  protected $height = self::DEFAULT_HEIGHT;

  protected $matrix = array();
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
      $this->matrix[$y] = array();
      for ($x = 0; $x < $this->width; $x++){
        $this->matrix[$y][$x] = self::BLANK_CHAR; 
      }
    }
  }

  public function setPixel($c, $char, $color = self::WHITE){
    $this->matrix[$c[1]][$c[0]] = "\033[{$color}m{$char}\033[0m";
  }

  public function clearPixel($c){
    $this->setPixel($c[0], $c[1], self::BLANK_CHAR);
  }

  // Thanks to http://free.pages.at/easyfilter/bresenham.html
  public function line($start, $finish, $char, $color = self::WHITE){
    list($x0, $y0) = $start;
    list($x1, $y1) = $finish;

    $dx = abs($x1 - $x0);
    $sx = ($x0 < $x1)? 1 : -1;

    $dy = -abs($y1 - $y0);
    $sy = ($y0 < $y1)? 1 : -1;

    $err = $dx + $dy;

    while (true){
      $this->setPixel(array($x0,$y0), $char, $color);
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

  public function sprite($c, $sprite, $color = self::WHITE){
    list($x, $y) = $c; 

    foreach ($sprite as $row){
      foreach ($row as $pixel){
        $this->setPixel(array($x, $y), $pixel, $color);
        $x++;
      }
      $x = $c[0]; // Reset the $x coord
      $y++;
    }
  }

  public function spriteWord($c, $word, $alphabet, $color = self::WHITE){
    list($x, $y) = $c;
    $chars = str_split(strToUpper($word));

    foreach ($chars as $char){
      if (!isSet($alphabet[$char])) continue;
      $sprite = $alphabet[$char];
      
      $this->sprite(array($x, $y), $sprite, $color);
      $x += 6;
    }
  }

  public function rect($c, $size, $char = '#', $color = self::WHITE){
    list($x, $y) = $c;
    list($w, $h) = $size;

    $this->line(array($x,    $y),    array($x+$w, $y),    $char, $color); // Top
    $this->line(array($x,    $y+$h), array($x+$w, $y+$h), $char, $color); // Bottom
    $this->line(array($x,    $y),    array($x,    $y+$h), $char, $color); // Left
    $this->line(array($x+$w, $y),    array($x+$w, $y+$h), $char, $color); // Right
  }

  // Thanks to http://free.pages.at/easyfilter/bresenham.html
  public function circle($c, $r, $char, $color = self::WHITE){
    list($xm, $ym) = $c;

    $x = -$r;
    $y = 0;
    $err = 2 - (2 * $r);

    do {
      $this->setPixel(array($xm-$x, $ym+$y), $char, $color);
      $this->setPixel(array($xm-$y, $ym-$x), $char, $color);
      $this->setPixel(array($xm+$x, $ym-$y), $char, $color);
      $this->setPixel(array($xm+$y, $ym+$x), $char, $color);
      $r = $err;

      if ($r <= $y){
        $err += (++$y * 2) + 1;
      }

      if ($r > $x || $err > $y){
        $err += (++$x * 2) + 1;
      }
    } while ($x < 0);
  }

  // Thanks to http://free.pages.at/easyfilter/bresenham.html
  public function ellipse($topLeft, $bottomRight, $char, $color = self::WHITE){
    list($x0, $y0) = $topLeft;
    list($x1, $y1) = $bottomRight;

    $a = abs($x1 - $x0);
    $b = abs($y1 - $y0);
    $b1 = $b & 1;

    $dx = 4 * (1 - $a) * $b * $b;
    $dy = 4 * ($b1 + 1) * $a * $a;
    
    $err = $dx + $dy + $b1 * $a * $a;

    if ($x0 > $x1){
      $x0 = $x1;
      $x1 += $a;
    }

    if ($y0 > $y1){
      $y0 = $y1;
    }

    $y0 += ($b + 1)/2;
    $y1 = $y0 - $b1;

    $a *= 8 * $a;
    $b1 = 8 * $b * $b;

    do {
      $this->setPixel(array($x1, $y0), $char, $color);
      $this->setPixel(array($x0, $y0), $char, $color);
      $this->setPixel(array($x0, $y1), $char, $color);
      $this->setPixel(array($x1, $y1), $char, $color);

      $e2 = 2 * $err;

      if ($e2 <= $dy){
        $y0++;
        $y1--;
        $err += $dy += $a;
      }

      if ($e2 >= $dx || 2*$err > $dy){
        $x0++;
        $x1--;
        $err += $dx += $b1;
      }
    } while ($x0 <= $x1);

    while (($y0 - $y1) < $b){
      $this->setPixel(array($x0-1, $y0),   $char, $color);
      $this->setPixel(array($x1+1, $y0++), $char, $color);
      $this->setPixel(array($x0-1, $y1),   $char, $color);
      $this->setPixel(array($x1+1, $y1--), $char, $color);
    }

  }

  // Thanks to http://free.pages.at/easyfilter/bresenham.html
  public function bezier($start, $control, $finish, $char, $color = self::WHITE){
    list($x0, $y0) = $start;
    list($x1, $y1) = $control;
    list($x2, $y2) = $finish;

    $sx = $x2 - $x1;
    $sy = $y2 - $y1;

    $xx = $x0 - $x1;
    $yy = $y0 - $y1;
    
    $cur = ($xx * $sy) - ($yy * $sx);

    assert(($xx * $sx) <= 0 && ($yy * $sy) <= 0);

    if (($sx * $sx + $sy * $sy) > ($xx * $xx + $yy * $yy)){
      $x2 = $x0;
      $x0 = $sx + $x1;
      $y2 = $y0;
      $y0 = $sy + $y1;
      $cur = -$cur;
    }

    if ($cur != 0){
      $xx += $sx;
      $xx *= $sx = ($x0 < $x2)? 1 : -1;

      $yy += $sy;
      $yy *= $sy = ($y0 < $y2)? 1 : -1;

      $xy = 2 * $xx * $yy;
      $xx *= $xx;
      $yy *= $yy;

      if (($cur * $sx * $sy) < 0){
        $xx = -$xx;
        $yy = -$yy;
        $xy = -$xy;
        $cur = -$cur;
      }

      $dx = 4 * $sy * $cur * ($x1 - $x0) + $xx - $xy;
      $dy = 4 * $sx * $cur * ($y0 - $y1) + $yy - $xy;

      $xx += $xx;
      $yy += $yy;
      $err = $dx + $dy + $xy;

      do {
        $this->setPixel(array($x0, $y0), $char, $color);
        if ($x0 == $x2 && $y0 == $y2) return true;

        $y1 = ((2 * $err) < $dx);

        if ((2 * $err) > $dy){
          $x0 += $sx;
          $dx -= $xy;
          $err += $dy += $yy;
        }

        if ($y1){
          $y0 += $sy;
          $dy -= $xy;
          $err += $dx += $xx;
        }
      } while ($dy < 0 && $dx > 0);

      $this->line(array($x0, $y0), array($x2, $y2), $char, $color);

      return true;
    }
  }

  public function text($c, $text, $width = null, $color = self::WHITE){
    list($x, $y) = $c;

    if (is_null($width)){
      $width = strlen($text);
    }

    $lines = explode("\n", wordwrap($text, $width, "\n"));

    foreach ($lines as $line){
      $chars = str_split($line);

      foreach ($chars as $char){
        if (!$char) continue;
        $this->setPixel(array($x, $y), $char, $color);
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

