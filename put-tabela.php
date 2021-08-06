<?php 
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL ^(E_WARNING | E_DEPRECATED));

  //use Classe\Util\Functions;
  use Classe\Tabela\Tabela;

  require_once __DIR__.'/assets/autoload.php';

  $tabela= new Tabela;
  $tabela->setTabela(@$_POST['id'],@$_POST['nome'],@$_POST['descricao'],@$_POST['pontuacao'],@$_POST['regra_pontuacao']);
  $tabela->updateTabela();

  if(empty(@$tabela->getId()))
  {
    echo "Não Atualizado";
  }
  else
  {
    echo "Atualizado";
    header('Location: tabelas.php');
  }
?>