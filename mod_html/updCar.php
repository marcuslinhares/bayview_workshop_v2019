<?php

    try{
        include('../classes/carros.classe.php');
        $carros = new Carros($pdo);
        $idCar= $_GET['id'];
        $dados=$carros->readuniupd($idCar);
       
    	if (isset($_POST['enviar']) ) {

    		$carros->update($idCar);
    	}

	}catch(Exception $e){
		 echo $e->getMessage();
	}
?>
<form  method="POST">

	<input type="hidden" name="enviar">
	<div class="form-group">
		<label for="placa">placa:</label>
		<input type="text" class="form-control" id="placa" data-mask='AAA-0000' name="placa" placeholder="Digite a placa" value="<?php echo $dados->placa ?>">
	</div>
	<div class="form-group">
		<label for="modelo">modelo</label>
		<input type="text" class="form-control" id="modelo" name="modelo" placeholder="Digite o modelo" value="<?php echo $dados->modelo ?>">
	</div>
	<div class="form-group">
		<label for="ano">ano</label>
		<input type="text" class="form-control" id="ano" name="ano" placeholder="Digite seu telefone" value="<?php echo $dados->ano?>">
	</div>

	<button type="submit" class="btn btn-primary">Editar</button>

</form>

