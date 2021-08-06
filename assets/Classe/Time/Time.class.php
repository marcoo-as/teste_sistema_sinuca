<?php 
	namespace Classe\Time;

	use Classe\Database\Connection;

	class Time {

		 private $database = false;
		 private $functions = false;

		 private $id = '';
		 private $nome = '';
		 private $jogador1 = '';
		 private $jogador2 = '';

		 function __construct() 
		 {
				$this -> database  = Connection::getConnection();
				//$this -> functions = new Functions;
		 }

		 /**
			* retorna Times no BD
			* 
			* retorna array de times
		*/
		public function getAllTimes() {

			$query = $this -> database -> query("
					SELECT
						id, nome, jogador1, jogador2
					FROM 
						times
					ORDER BY nome") 
							or die($this -> database -> error);
			$Xtimes = [];
			while($time = $query -> fetch_assoc())
			{
				$timeC = new Time();
				$timeC->setTime($time['id'],$time['nome'],$time['jogador1'],$time['jogador2']);
				$Xtimes[] = $timeC;
			}

			return $Xtimes;
		}

		 /**
			* retorna Times DA tABELA no BD
			* 
			* retorna array de times
		*/
		public function getAllTimesNotTabela($idTabela) {

			$query = $this -> database -> query("
					SELECT
						id, nome, jogador1, jogador2
					FROM 
						times
					WHERE id NOT IN (SELECT idTime FROM tabelas_times WHERE idTabela = '".$idTabela."')
					ORDER BY nome") 
							or die($this -> database -> error);
			$Xtimes = [];
			while($time = $query -> fetch_assoc())
			{
				$timeC = new Time();
				$timeC->setTime($time['id'],$time['nome'],$time['jogador1'],$time['jogador2']);
				$Xtimes[] = $timeC;
			}

			return $Xtimes;
		}

		/**
			* retorna as informações do Time no BD
			* 
			* @id - Id do Time no BD
			*
		*/
		public function getTime($id) {
			$query = $this -> database -> query("
					SELECT
						id, nome, jogador1, jogador2
					FROM 
						times
					WHERE 
						times.id='".$id."'
					LIMIT 1") 
							or die($this -> database -> error);

			$time = $query -> fetch_assoc();
			$this->setTime($time['id'], $time['nome'], $time['jogador1'], $time['jogador2']);

			return true;
		}

		/**
			* atualizar as informações do Time
			* 
			* @id - Id do Time no BD
			* @nome - Nome do Time no BD
			* @jogador1 - Jogador 1 do Tim eno BD
			* @jogador2 - Jogador 2 do Tim e no BD
		*/
		public function setTime($id, $nome, $jogador1, $jogador2) {
			$this->setId($id);
			$this->setNome($nome);
			$this->setJogador1($jogador1);
			$this->setJogador2($jogador2);
			return true;
		}

		/**
			* atualizar as informações do Time no BD
			* 
		*/
		public function updateTime() {
			$query = $this -> database -> query("
					UPDATE
						times
					SET
						nome = '".$this->getNome()."',
						jogador1 = '".$this->getJogador1()."', 
						jogador2 = '".$this->getJogador2()."'
					WHERE 
						times.id='".$this->getId()."'
					LIMIT 1") 
							or die($this -> database -> error);
			return true;
		}

		/**
			* Insere as informações do Time no BD
			* 
			* @nome - Nome do Time no BD
			* @jogador1 - Jogador 1 do Tim eno BD
			* @jogador2 - Jogador 2 do Tim e no BD
		*/
		public function newTime($param) {

			$query = $this -> database -> query("
				INSERT INTO times (nome,jogador1,jogador2) 
				VALUES ('".@$param['nome']."','".@$param['jogador1']."','".@$param['jogador2']."')") 
						or die($this -> database -> error);

			$this->getTime($this->database->insert_id);
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
  
		public function getJogador1() {
			return $this->jogador1;
		}
  
		public function setJogador1($nome) {
			$this->jogador1 = $nome;
		}

		public function getJogador2() {
			return $this->jogador2;
		}
  
		public function setJogador2($nome) {
			$this->jogador2 = $nome;
		}
	}
?>