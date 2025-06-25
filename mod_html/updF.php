<?php

	try{
    
        include('../classes/funcionarios.classe.php');
        $funcionarios = new Funcionarios($pdo);
        $id = $_GET['id'];
        
        $dados=$funcionarios->readuni($id);
        if (isset($_POST['enviar']) ) {
        	$funcionarios->update($id);
        	header('location:inicial.php?red=verF');
        }

	}catch(Exception $e){
		 echo $e->getMessage();
	} 

?>
<form action="" method="post">

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
		<label for="email">telefone</label>
		<input type="text" class="form-control" id="email" data-mask='00000-0000' name="telefone" placeholder="Digite o telefone" value="<?php echo $dados->telefone?>">
	</div>
	<div class="form-group">
		<label for="cidade">Cidade</label>
		<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Digite a cidade" value="<?php echo $dados->cidade?>">
	</div>
	<button type="submit" class="btn btn-primary">Editar</button>

</form>
