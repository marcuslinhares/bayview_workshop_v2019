<?php 
	
	class Verificador {

		private $pdo;

		function __construct($arg){
			$this->pdo=$arg;
		}
		
		function verifica(){

			if(isset($_POST['cpf']) and !empty($_POST['cpf'])){
				$cpf = trim($_POST['cpf']);
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>Campo CPF vazio</div>", 101);
			}

			if(isset($_POST['senha']) and !empty($_POST['senha'])){
				$senha = trim($_POST['senha']);
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>Campo senha vazio</div>", 101);
			}
			
			$select = $this->pdo->prepare("SELECT * FROM funcionario WHERE cpf = :cpf AND senha = :senha AND disp = :disp");
			$select->bindValue(':cpf', $cpf);
			$select->bindValue(':senha', $senha);
			$select->bindValue(':disp', 1);
			$select->execute();

			if($select->rowCount() == 1){

				$rs=$select->fetch(PDO::FETCH_OBJ);

				$idF=$rs->id_funcionario;
				$nivel=$rs->nivel;
				session_start();
				$_SESSION['user'] = $nivel;
				$_SESSION['idF'] = $idF;
				header('location:mod_html/inicial.php');

				
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>Campos incorretos</div>");
			}
		}
	}


?>