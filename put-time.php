<?php 
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL ^(E_WARNING | E_DEPRECATED));

  //use Classe\Util\Functions;
  use Classe\Time\Time;

  require_once __DIR__.'/assets/autoload.php';

  $time= new Time;
  $time->setTime(@$_POST['id'],@$_POST['nome'],@$_POST['jogador1'],@$_POST['jogador2']);
  $time->updateTime();

  if(empty(@$time->getId()))
  {
    echo "Não Atualizado";
  }
  else
  {
    echo "Atualizado";
    header('Location: times.php');
  }
?>