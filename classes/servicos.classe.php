<?php
	
	class Servicos {

		private $pdo;

		function __construct($arg){
			$this->pdo=$arg;
		}
		
		function create($idCar, $tipo, $idF){

			$insSer = $this->pdo->prepare("INSERT INTO servico (tipo, carro_idcarro, funcionario_id_funcionario) VALUES (?, ?, ?)");
			$insSer->bindParam(1, $tipo);
			$insSer->bindParam(2, $idCar);
			$insSer->bindParam(3, $idF);
			if ($insSer->execute()){
				echo "<div class='alert alert-success'>Ficha cadastrada com sucesso</div>";
			}else{
			    throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
			}

			$tipo = null;
			
		}

		function delete($idSer){

    		$stmt = $this->pdo->prepare("DELETE FROM servico WHERE id_servico = :idSer");
    		$stmt->bindValue(':idSer', $idSer);
    		if ($stmt->execute()) {
    			$placa=null;
    			echo"<script>location.href='../mod_html/inicial.php?red=verC';</script>";

    		}else{
    			throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
    		}
				
		}

		function readunifi($idCar){
			$selecionar = $this->pdo->prepare('SELECT * FROM servico WHERE carro_idcarro = :idCar');
			$selecionar->bindValue(':idCar',$idCar);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}

		}

		function readunidell($idCar){
			$selecionar = $this->pdo->prepare('SELECT * FROM servico WHERE carro_idcarro = :idCar');
			$selecionar->bindValue(':idCar',$idCar);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}

		}
	}

?>