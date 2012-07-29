<?php
class Sprite {
  public static function fromImage($filename){
    if (!file_exists($filename)) return [];

    $ascii = shell_exec("jp2a --height=26 -i ".escapeshellarg($filename)." | grep -vE '^\s*$'");

    return explode("\n", $ascii);
  }
}
