<?php 
	namespace Classe\Tabela_Time ;

	use Classe\Database\Connection;
	//use Classe\Util\Functions;


	class Tabela_Time {

		 private $database = false;
		 private $functions = false;

		 private $nome = '';
		 private $descricao = '';
		 private $pontuacao = '';
		 private $regra_pontuacao = '';

		 function __construct() 
		 {
				$this -> database  = Connection::getConnection();
				//$this -> functions = new Functions;
		 }

		/**
			* retorna as informaчѕes da Tabela no BD
			* 
			* @id - Id da Tabela no BD
			*
		*/
		public function getTabela($id) {
			$query = $this -> database -> query("
					SELECT
						id, nome, descricao, pontuacao, regra_pontuacao
					FROM 
						tabelas
					WHERE 
						tabelas.id='".$id."'
					LIMIT 1") 
							or die($this -> database -> error);

			$tabela = $query -> fetch_assoc();
			$this->setNome($tabela['nome']);
			$this->setDescricao($tabela['descricao']);
			$this->setPontuacao($tabela['pontuacao']);
			$this->setRegra($tabela['regra_pontuacao']);

			return true;
		}

		/**
			* atualizar as informaчѕes da Tabela no BD
			* 
			* @id - Id da Tabela no BD
			* @nome - Nome da Tabela no BD
			* @descricao - Descriчуo da Tabela no BD
			* @pontuacao - Pontuaчуo da Tabela no BD
			* @regra_pontuacao - Regra de Pontuaчуo da Tabela no BD
		*/
		public function setTabela($id, $nome, $descricao, $pontuacao, $regra_pontuacao) {
			$query = $this -> database -> query("
					UPDATE
						nome = '".$nome."',
						descricao = '".$descricao."', 
						pontuacao = '".$pontuacao."',
						regra_pontuacao = '".$regra_pontuacao."'
					SET
						tabelas
					WHERE 
						tabelas.id='".$id."'
					LIMIT 1") 
							or die($this -> database -> error);

			$this->setNome($nome);
			$this->setDescricao($descricao);
			$this->setPontuacao($pontuacao);
			$this->setRegra($regra_pontuacao);
			return true;
		}

		public function getNome() {
			return $this->nome;
		}
  
		public function setNome($nome) {
			$this->nome= $nome;
		}
  
		public function getDescricao() {
			return $this->descricao;
		}
  
		public function setDescricao($nome) {
			$this->descricao = $nome;
		}

		public function getPontuacao() {
			return $this->pontuacao;
		}
  
		public function setPontuacao($nome) {
			$this->pontuacao = $nome;
		}

		public function getRegra() {
			return $this->regra_pontuacao;
		}
  
		public function setRegra($nome) {
			$this->regra_pontuacao = $nome;
		}
	}
?>