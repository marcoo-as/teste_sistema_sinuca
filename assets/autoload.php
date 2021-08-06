<?php 
  spl_autoload_register(function ($class) {
     require_once(str_replace('\\', '/', __DIR__.'/'.$class . '.class.php'));
  });

  //include("functions.php");
  include("constantes.php");

?>