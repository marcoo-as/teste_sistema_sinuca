<?php 
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL ^(E_WARNING | E_DEPRECATED));

  //use Classe\Util\Functions;
  use Classe\Time\Time;

  require_once __DIR__.'/assets/autoload.php';

  $time= new Time;
  $time->newTime(@$_POST);

  if(empty(@$time->getId()))
  {
    echo "Não Cadastrado";
  }
  else
  {
    echo "Cadastrado";
    header('Location: times.php');
  }
?>