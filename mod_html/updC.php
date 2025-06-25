<?php
    try{
        include('../classes/clientes.classe.php');
        $carros = new Clientes($pdo);
        $idC= $_GET['id'];
        $dados=$carros->readuniupd($idC);
       
    	if (isset($_POST['enviar']) ) {
    		$carros->update($idC);
    	}

	}catch(Exception $e){
	    echo $e->getMessage();
	}
?>
	<form method="post">

		<input type="hidden" name="enviar">
		<div class="form-group">
			<label for="nome">Nome:</label>
			<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" value="<?php echo $dados->nome ?>">
		</div>
		<div class="form-group">
			<label for="cpf">cpf</label>
			<input type="text" class="form-control" id="cpf" data-mask='000.000.000-00' name="cpf" placeholder="Digite o cpf" value="<?php echo $dados->cpf?>">
		</div>
		<div class="form-group">
			<label for="telefone">telefone</label>
			<input type="text" class="form-control" id="telefone" data-mask='00000-0000' name="telefone" placeholder="Digite o telefone" value="<?php echo $dados->telefone?>">
		</div>
		<div class="form-group">
			<label for="cidade">Cidade</label>
			<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Digite a cidade" value="<?php echo $dados->cidade?>">
		</div>
		<button type="submit" class="btn btn-primary">Editar</button>

	</form>
