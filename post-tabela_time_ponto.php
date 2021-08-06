<?php 
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL ^(E_WARNING | E_DEPRECATED));

  //use Classe\Util\Functions;
  use Classe\Tabela\Tabela;

  require_once __DIR__.'/assets/autoload.php';

  $tabela= new Tabela;
  $tabela->updateTabelaTime(@$_POST);

  echo "Cadastrado";
  header('Location: tabela_times.php?i='.$_POST['idTabela']);
?>