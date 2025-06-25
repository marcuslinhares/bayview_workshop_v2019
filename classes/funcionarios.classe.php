<?php
	
	class Funcionarios {

		private $pdo;

		function __construct($arg){
			$this->pdo=$arg;
		}
		
		function create($nome, $cpf, $telefone, $cidade, $senha){
			
			$nivel=0;
			$disp=1;
			$insFun = $this->pdo->prepare("INSERT INTO funcionario (nome, cpf, telefone, cidade, senha, nivel, disp) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$insFun->bindParam(1, $nome);
			$insFun->bindParam(2, $cpf);
			$insFun->bindParam(3, $telefone);
			$insFun->bindParam(4, $cidade);
			$insFun->bindParam(5, $senha);
			$insFun->bindParam(6, $nivel);
			$insFun->bindParam(7, $disp);

			if ($insFun->execute()){
				echo "<div class='alert alert-success'>Funcionario cadastrado com sucesso</div>";
			}	
		}

		function read(){

    		$stmt = $this->pdo->prepare("SELECT * FROM funcionario WHERE disp = 1");

    		if($stmt->execute()){
    			if ($stmt->rowCount() > 0) {
    				while($rs=$stmt->fetch(PDO::FETCH_OBJ)){
            			echo "<tr>";
            			echo "<td>".$rs->id_funcionario."</td><td>".$rs->nome."</td><td>".$rs->cpf."</td><td>".$rs->telefone."</td><td>".$rs->cidade."</td><td>".$rs->nivel."</td><td><center><a class='btn btn-info' href=?red=updF&id=".$rs->id_funcionario.">Alterar</a>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<a class='btn btn-danger' href=?red=delF&id=".$rs->id_funcionario.">Deletar</a></center></td>";
            			echo "</tr>";
    				}
    			}else{
    				throw new Exception("<div class=' alert alert-danger' role='alert'>Nenhum funcionario cadastrado.</div>", 101);
    			}

    		}else{
    				throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
    		}
		}
		
		function delete($id){

        	$dellF = $this->pdo->prepare("UPDATE funcionario SET disp=:disp WHERE id_funcionario = :id");
    		$dellF->bindValue(':id', $id, PDO::PARAM_INT);
    		$dellF->bindValue(':disp', 0);

    		if ($dellF->execute()) {
    			$id=null;
    		    echo"<script>location.href='../mod_html/inicial.php?red=verF';</script>";

    		}else{
    			throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
    		}

			
		}

		function update($id){

			if(isset($_POST['nome']) AND !empty($_POST['nome'])){
				$nome = $_POST['nome'];
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>O campo nome é obrigatório.</div>", 101);
			}

			if(isset($_POST['cpf']) AND !empty($_POST['cpf'])){
				$cpf = $_POST['cpf'];
			} else{
			    throw new Exception("<div class=' alert alert-danger' role='alert'>O campo cpf é obrigatório.</div>", 101);
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

			$updCli = $this->pdo->prepare("UPDATE funcionario SET nome=:nome, cpf = :cpf, telefone = :telefone, cidade = :cidade WHERE id_funcionario = :id");
			$updCli->bindValue(':id', $id);
			$updCli->bindValue(':nome', $nome);
			$updCli->bindValue(':cpf', $cpf);
			$updCli->bindValue(':telefone', $telefone);
			$updCli->bindValue(':cidade', $cidade);
			
			if($updCli->execute()){
				echo"<script>location.href='../mod_html/inicial.php?red=verF';</script>";
			} else{
				throw new Exception("<div class=' alert alert-danger' role='alert'>Falha na ação.</div>", 101);
			}

		}

		function readuni($id){
			$selecionar = $this->pdo->prepare('SELECT * FROM funcionario WHERE id_funcionario = :id');
			$selecionar->bindValue(':id',$id);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}

		function readunidell($id){
			$selecionar = $this->pdo->prepare('SELECT * FROM funcionario WHERE id_funcionario = :id');
			$selecionar->bindValue(':id',$id);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}

		function readunicadver($cpf){
			$selecionar = $this->pdo->prepare('SELECT * FROM funcionario WHERE cpf = :cpf');
			$selecionar->bindValue(':cpf', $cpf);
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				throw new Exception("<div class=' alert alert-danger' role='alert'>este cpf ja esta cadastrado</div>", 102);
			}
		}
	}

?>