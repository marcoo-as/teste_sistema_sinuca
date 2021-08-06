<?php 
	namespace Classe\Tabela;

	use Classe\Database\Connection;
	use Classe\Time\Time;
	//use Classe\Util\Functions;


	class Tabela {

		 private $database = false;
		 private $functions = false;

		 private $id = '';
		 private $nome = '';
		 private $descricao = '';
		 private $pontuacao = 0;
		 private $regra_pontuacao = '';
		 private $vencedor = '';
		 private $times = [];

		 function __construct() 
		 {
				$this -> database  = Connection::getConnection();
				//$this -> functions = new Functions;
		 }

		 /**
			* retorna Tabelas no BD
			* 
			* retorna array de tabelas
		*/
		public function getAllTabelas() {

			$query = $this -> database -> query("
					SELECT
						id, nome, descricao, pontuacao, regra_pontuacao
					FROM 
						tabelas
					ORDER BY nome") 
							or die($this -> database -> error);
			$Xtabelas = [];
			while($tabela = $query -> fetch_assoc())
			{
				$tabelaC = new Tabela();
				$tabelaC ->setTabela($tabela['id'],$tabela['nome'],$tabela['descricao'],$tabela['pontuacao'],$tabela['regra_pontuacao']);
				$Xtabelas[] = $tabelaC ;
			}

			return $Xtabelas;
		}

		/**
			* retorna as informações da Tabela no BD
			* 
			* @id - Id da Tabela no BD
			*
		*/
		public function getTabela($id) {
			//Dados tabela
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
			$this->setTabela($tabela['id'], $tabela['nome'], $tabela['descricao'], $tabela['pontuacao'], $tabela['regra_pontuacao']);

			//Times da tabela
			$query = $this -> database -> query("
					SELECT
						tabelas_times.id, tabelas_times.idTabela, tabelas_times.idTime, tabelas_times.pontos, 
						times.nome AS Tnome
					FROM 
						tabelas_times
					LEFT JOIN times ON (times.id = tabelas_times.idTime)
					WHERE 
						tabelas_times.idTabela='".$id."'
					GROUP BY tabelas_times.id
					ORDER BY tabelas_times.pontos DESC") 
							or die($this -> database -> error);
			while($time= $query -> fetch_assoc())
			{
				$this->setTimeTabela($time);
				if($time['pontos'] == $this->getPontuacao())
					$this->setVencedor($time['idTime']);
			}

			return true;
		}

		/**
			* atualizar as informações da Tabela
			* 
			* @id - Id da Tabela no BD
			* @nome - Nome da Tabela no BD
			* @descricao - Descrição da Tabela no BD
			* @pontuacao - Pontuação da Tabela no BD
			* @regra_pontuacao - Regra de Pontuação da Tabela no BD
		*/
		public function setTabela($id, $nome, $descricao, $pontuacao, $regra_pontuacao) {
			$this->setId($id);
			$this->setNome($nome);
			$this->setDescricao($descricao);
			$this->setPontuacao($pontuacao);
			$this->setRegra($regra_pontuacao);
			return true;
		}

		/**
			* atualizar as informações da Tabela no BD
			* 
		*/
		public function updateTabela() {
			$query = $this -> database -> query("
					UPDATE
						tabelas
					SET
						nome = '".$this->getNome()."',
						descricao = '".$this->getDescricao()."', 
						pontuacao = '".$this->getPontuacao()."',
						regra_pontuacao = '".$this->getRegra()."'
					WHERE 
						tabelas.id='".$this->getId()."'
					LIMIT 1") 
							or die($this -> database -> error);
			return true;
		}

		/**
			* Insere as informações da Tabela no BD
			* 
			* @param - Array com informações
		*/
		public function newTabela($param) {

			$query = $this -> database -> query("
				INSERT INTO tabelas (nome,descricao,pontuacao,regra_pontuacao) 
				VALUES ('".@$param['nome']."','".@$param['descricao']."','".@$param['pontuacao']."','".@$param['regra_pontuacao']."')") 
						or die($this -> database -> error);

			$this->getTabela($this->database->insert_id);
			return true;
		}

		/**
			* Times informados na tabela
			* 
			* @param - Array com informações do time
		*/
		public function setTimeTabela($param) {
			$this->times[] = $param;
			return true;
		}

		/**
			* Get Times informados na tabela
			* 
		*/
		public function getTimeTabela() {
			return $this->times;
		}

		/**
			* Insere as informações da do Time na Tabela no BD
			* 
			* @param - Array com informações
		*/
		public function newTabelaTime($param) {
			$this->getTabela(@$param['idTabela']);

			//Verifica a quantidade de times na Tabela
			if(count($this->getTimeTabela()) < MAX_TIMES && !empty($this->getVencedor()))
			{
				$query = $this -> database -> query("
					INSERT INTO tabelas_times (idTime,idTabela) 
					VALUES ('".@$param['idTime']."','".@$param['idTabela']."')") 
							or die($this -> database -> error);
			}

			return true;
		}

		/**
			* Atualiza informações da do Time na Tabela no BD
			* 
			* @param - Array com informações
		*/
		public function updateTabelaTime($param) {
				$query = $this -> database -> query("
					UPDATE tabelas_times 
					SET pontos = pontos + ".intval($param['pontos'])."
					WHERE id = '".@$param['id']."'
					LIMIT 1") 
							or die($this -> database -> error);
			return true;
		}

		public function getId() {
			return $this->id;
		}
  
		public function setId($id) {
			$this->id= $id;
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
  
		public function setPontuacao($pontos) {
			$this->pontuacao = $pontos;
		}

		public function getRegra() {
			return $this->regra_pontuacao;
		}
  
		public function setRegra($nome) {
			$this->regra_pontuacao = $nome;
		}

		public function getVencedor() {
			return $this->vencedor;
		}
  
		public function setVencedor($id) {
			$this->vencedor = $id;
		}
	}
?>