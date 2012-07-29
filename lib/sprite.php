<?php
class Sprite {
  public static function fromImage($filename, $height = 26){
    if (!file_exists($filename)) return [];

    $height = (int) $height;
    $filename = escapeshellarg($filename);
    $ascii = shell_exec("jp2a --height={$height} -i {$filename} | grep -vE '^\s*$'");

    return explode("\n", $ascii);
  }
}
