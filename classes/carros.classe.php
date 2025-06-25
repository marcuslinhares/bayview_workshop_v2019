<?php

	class Carros{
		
		private $pdo;

		function __construct($arg){
			$this->pdo=$arg;
		}
		
		function create($idCli, $placa){

			$selecionar = $this->pdo->prepare('SELECT * FROM carro WHERE placa = :placa');
			$selecionar->bindValue(':placa', $placa);
			$selecionar->execute();

			if($selecionar->rowCount() > 0){
				throw new Exception("<div class=' alert alert-danger' role='alert'>esta placa ja esta cadastrada</div>", 102);
			} else{

				$modelo = $_POST['modelo'];
				$ano= $_POST['ano'];

				$insCar = $this->pdo->prepare("INSERT INTO carro (placa, modelo, ano, cliente_id_cliente) VALUES (?, ?, ?, ?)");
				$insCar->bindParam(1, $placa);
				$insCar->bindParam(2, $modelo);
				$insCar->bindParam(3, $ano);
				$insCar->bindParam(4, $idCli);

				$insCar->execute();

				$placa = null;
				$modelo = null;
				$ano = null;
			}
			
		}

		function read(){

        	$stmt = $this->pdo->prepare("SELECT * FROM carro");

    		if($stmt->execute()){
    			if ($stmt->rowCount() > 0) {
    				while($rs=$stmt->fetch(PDO::FETCH_OBJ)){
    				echo "<tr>";
    				echo "<td>".$rs->idcarro."</td><td>".$rs->placa."</td><td>".$rs->modelo."</td><td>".$rs->ano."</td><td><center><a class='btn btn-info' href=\"?red=updCar&id=" . $rs->idcarro . "\">Alterar</a>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"."<a class='btn btn-success' href=\"?red=verFi&idCar=" . $rs->idcarro . "\">Ficha</a></center></td>";
    				echo "</tr>";
    				}
    			}else{
    				throw new Exception("<div class=' alert alert-danger' role='alert'>Nenhum carro cadastrado.</div>", 101);
    			}

    		}else{
    			throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
    		}

		}

		function delete($idCar){

    		$stmt = $this->pdo->prepare("DELETE FROM carro WHERE idcarro = :idCar");
    		$stmt->bindValue(':idCar', $idCar);
	    	if ($stmt->execute()) {
	    	    header('location:inicial.php?red=verCar');
        	}else{
    			throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
    		}
		}

		function update($idCar){

			if(isset($_POST['placa']) AND !empty($_POST['placa'])){
				$placa = $_POST['placa'];
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>O campo placa é obrigatório.</div>", 101);
			}

			if(isset($_POST['modelo']) AND !empty($_POST['modelo'])){
				$modelo = $_POST['modelo'];
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>O campo modelo é obrigatório.</div>", 101);
			}

			if(isset($_POST['ano']) AND !empty($_POST['ano'])){
				$ano = $_POST['ano'];
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>O campo ano é obrigatório.</div>", 101);
			}

			$updCli = $this->pdo->prepare("UPDATE carro SET placa=:placa, modelo = :modelo, ano = :ano WHERE idcarro = :idCar");
			$updCli->bindValue(':idCar', $idCar);
			$updCli->bindValue(':placa', $placa);
			$updCli->bindValue(':modelo', $modelo);
			$updCli->bindValue(':ano', $ano);
			
			if($updCli->execute()){
			    echo"<script>location.href='../mod_html/inicial.php?red=verCar';</script>";
			}
			
		}
		function readunidados($idCar){
			$selecionar = $this->pdo->prepare('SELECT * FROM carro WHERE idcarro = :idCar');
			$selecionar->bindValue(':idCar',$idCar);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}

		}

		function readunifi($idCli){
			$selecionar = $this->pdo->prepare('SELECT * FROM carro WHERE cliente_id_cliente = :idCli');
			$selecionar->bindValue(':idCli',$idCli);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}

		}

		function readuniupd($idCar){
			$selecionar = $this->pdo->prepare('SELECT * FROM carro WHERE idcarro = :idCar');
			$selecionar->bindValue(':idCar',$idCar);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}

		}

		function readunicad($placa){
			$selecionar = $this->pdo->prepare('SELECT * FROM carro WHERE placa = :placa');
			$selecionar->bindValue(':placa',$placa);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}

		}

		function readunidell($idCli){
			$selecionar = $this->pdo->prepare('SELECT * FROM carro WHERE cliente_id_cliente = :idCli');
			$selecionar->bindValue(':idCli',$idCli);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}

		}

		function readunicadver($placa){
			$selecionar = $this->pdo->prepare('SELECT * FROM carro WHERE placa = :placa');
			$selecionar->bindValue(':placa',$placa);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				throw new Exception("<div class=' alert alert-danger' role='alert'>esta placa ja esta cadastrado</div>", 102);
			}
		}
	}


?>