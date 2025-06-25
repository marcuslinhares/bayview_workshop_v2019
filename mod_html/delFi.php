<?php

    try{
        
    	$idCli=$_SESSION['id'];
    
    	if (isset($_POST['deletar'])) {
    
    		include("../classes/clientes.classe.php");
    		$clientes = new Clientes($pdo);
    
    		include("../classes/carros.classe.php");
    		$carros = new Carros($pdo);
    
    		include("../classes/servicos.classe.php");
    		$servicos = new Servicos($pdo);
    
    		$dadosCar = $carros->readunidell($idCli);
    
    		$idCar = $dadosCar->idcarro;
    
    		$dadosSer = $servicos->readunidell($idCar);
    
    		$idSer = $dadosSer->id_servico;
    
    		$servicos-> delete($idSer);
    		$carros-> delete($idCar);
    		$clientes-> delete($idCli);	
    
    	}
    	
    	if (isset($_POST['cancelar'])) {
    		 echo"<script>location.href='../mod_html/inicial.php?red=verC';</script>";
    	}
    	
    }catch(Exception $e){
		echo $e;
	}

?>
<div class="col-md-8 ml-auto mr-auto">
    <div class="card">
    	<div class="header text-center">
    		<h4 class="title">Deseja realmente apagar os dados desta ficha?</h4>
        </div>
        <div class="container" style="text-align: center;">
			<form method="POST" name="form_cadastro">
				<div class="contente">
					<input class="btn btn-success" type="submit" name="deletar" value="sim">
					<input class="btn btn-danger" type="submit" name="cancelar" value="cancelar">
				</div>
			</form>
			<br>
		</div>
	</div>
</div>