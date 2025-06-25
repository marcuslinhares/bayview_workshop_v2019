<?php		

	class Clientes {

		private $pdo;

		function __construct($arg){
			$this->pdo=$arg;
		}
		
		function create($nome, $cpf, $telefone){

				$cidade = $_POST['cidade'];

				$insCli = $this->pdo->prepare("INSERT INTO cliente (nome, cpf, telefone, cidade) VALUES (?, ?, ?, ?)");
				$insCli->bindParam(1, $nome);
				$insCli->bindParam(2, $cpf);
				$insCli->bindParam(3, $telefone);
				$insCli->bindParam(4, $cidade);
				if (!$insCli->execute()) {
					throw new Exception("erro ao registrar", 103);
				}
				
				$nome = null;
				$telefone = null;
				$cpf = null;
				$cidade = null;

		}

		function read(){

    		$stmt = $this->pdo->prepare("SELECT * FROM cliente");

    		if($stmt->execute()){
    			if ($stmt->rowCount() > 0) {
    				while($rs=$stmt->fetch(PDO::FETCH_OBJ)){
    				echo "<tr>";
    				echo "<td>".$rs->id_cliente."</td><td>".$rs->nome."</td><td>".$rs->cpf."</td><td>".$rs->telefone."</td><td>".$rs->cidade."</td><td><center><a class='btn btn-info' href=\"?red=updC&id=" . $rs->id_cliente . "\">Alterar</a>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<a class='btn btn-success' href=\"?red=verFi&idC=" . $rs->id_cliente . "\">Ficha</a></center></td>";
    				echo "</tr>";
    				}
    			}else{
    				throw new Exception("<div class=' alert alert-danger' role='alert'>Nenhum cliente registrado.</div>", 101);
    			}
    		}else{
    				throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
    		}
		}

		function delete($id){

    		$stmt = $this->pdo->prepare("DELETE FROM cliente WHERE id_cliente = :id");
    		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
    		if ($stmt->execute()) {
    			$id=null;

    		}else{
    				throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
    		}
				
		}

		function update($idCli){
		
			if(isset($_POST['nome']) AND !empty($_POST['nome'])){
				$nome = $_POST['nome'];
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>O campo nome é obrigatório.</div>", 101);
			}

			if(isset($_POST['cpf']) AND !empty($_POST['cpf'])){
				$cpf = $_POST['cpf'];
			} else{
			    throw new Exception("<div class=' alert alert-danger' role='alert'>O campo CPF é obrigatório.</div>", 101);
			}
			if(isset($_POST['telefone']) AND !empty($_POST['telefone'])){
				$telefone = $_POST['telefone'];
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>O campo telefone é obrigatório.</div>", 101);
			}
			if(isset($_POST['cidade']) AND !empty($_POST['cidade'])){
				$cidade = $_POST['cidade'];
			} else{
			    throw new Exception("<div class=' alert alert-danger' role='alert'>O campo cidade é obrigatório.</div>", 101);
			}

			$updCli = $this->pdo->prepare("UPDATE cliente SET nome=:nome, cpf = :cpf, telefone = :telefone, cidade = :cidade WHERE id_cliente = :idCli");
			$updCli->bindValue(':idCli', $idCli);
			$updCli->bindValue(':nome', $nome);
			$updCli->bindValue(':cpf', $cpf);
			$updCli->bindValue(':telefone', $telefone);
			$updCli->bindValue(':cidade', $cidade);

			
			if($updCli->execute()){
				 echo"<script>location.href='../mod_html/inicial.php?red=verC';</script>";
			} else{
				 throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
			}

		}

		function readuniupd($idCli){
			$selecionar = $this->pdo->prepare('SELECT * FROM cliente WHERE id_cliente = :id');
			$selecionar->bindValue(':id',$idCli);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}

		function readunifi($idCli){
			$selecionar = $this->pdo->prepare('SELECT * FROM cliente WHERE id_cliente = :id');
			$selecionar->bindValue(':id',$idCli);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}

		function readunicad($cpf){
			$selecionar = $this->pdo->prepare('SELECT * FROM cliente WHERE cpf = :cpf');
			$selecionar->bindValue(':cpf', $cpf);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}

		function readunidell($idCli){
			$selecionar = $this->pdo->prepare('SELECT * FROM cliente WHERE id_cliente = :id');
			$selecionar->bindValue(':id',$idCli);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}

		function readunicadver($cpf){
			$selecionar = $this->pdo->prepare('SELECT * FROM cliente WHERE cpf = :cpf');
			$selecionar->bindValue(':cpf', $cpf);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				throw new Exception("<div class=' alert alert-danger' role='alert'>este cpf ja esta cadastrado</div>", 102);
			}
		}
	}

?>