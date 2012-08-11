<?php

spl_autoload_register(function($class){
  $class = strToLower($class);
  require __DIR__."/{$class}.php";
});
