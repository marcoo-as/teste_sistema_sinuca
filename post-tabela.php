<?php 
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL ^(E_WARNING | E_DEPRECATED));

  //use Classe\Util\Functions;
  use Classe\Tabela\Tabela;

  require_once __DIR__.'/assets/autoload.php';

  $tabela= new Tabela;
  $tabela->newTabela(@$_POST);

  if(empty(@$tabela->getId()))
  {
    echo "N�o Cadastrado";
  }
  else
  {
    echo "Cadastrado";
    header('Location: tabelas.php');
  }
?>