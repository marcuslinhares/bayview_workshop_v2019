<?php
	include("../classes/clientes.classe.php");
	$clientes = new Clientes($pdo);
	
	include("../classes/carros.classe.php");
	$carros = new Carros($pdo);
	
	include("../classes/servicos.classe.php");
	$servicos = new Servicos($pdo);
	
	if(isset($_GET['idC'])){
	    $idCli=$_GET['idC'];
    	$_SESSION['id']=$_GET['idC'];
    	$dadosCli = $clientes-> readunifi($idCli);
    	$dadosCar = $carros-> readunifi($idCli);
    	$idCar=$dadosCar->idcarro;
    	$dadosSer = $servicos-> readunifi($idCar);
	}
	
	if(isset($_GET['idCar'])){
	    $idCar=$_GET['idCar'];
	    $dadosCar = $carros-> readunidados($idCar);
	    $idCli= $dadosCar->cliente_id_cliente;
	    $dadosCli = $clientes-> readunifi($idCli);
    	$_SESSION['id']=$idCli;
    	$dadosSer = $servicos-> readunifi($idCar);
	}
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card strpied-tabled-with-hover">
					<div class="card-header ">
					 	<h4 class="card-title">Ficha do cliente</h4>
					</div>
					 <div class="card-body table-full-width table-responsive">
						<table class="table table-hover table-striped">
							<tr>

								<th>cliente</th>
									<?php if($dadosCli->nome != null ){?><td><?php echo 'Nome: ' .$dadosCli->nome; }?></td>
									<?php if($dadosCli->cpf != null ){?><td><?php echo 'CPF: '. $dadosCli->cpf; }?></td>
									<?php if($dadosCli->telefone != null ){?><td><?php echo'Telefone: '. $dadosCli->telefone; }?></td>
									<?php if($dadosCli->cidade != null ){?><td><?php echo'Cidade: '. $dadosCli->cidade; }?></td>
							</tr>
							<tr>
								<th>carro</th>
									<?php if($dadosCar->placa != null ){?><td><?php echo'Placa: '. $dadosCar->placa; }?></td>
									<?php if($dadosCar->modelo != null ){?><td><?php echo'Modelo: '. $dadosCar->modelo; }?></td>
									<?php if($dadosCar->ano != null ){?><td><?php echo'Ano: '. $dadosCar->ano; }?></td>
							</tr>
								<tr>
								<th>serviço</th>
									<?php if($dadosSer->tipo != null ){?><td><?php echo'Serviço: '. $dadosSer->tipo; }?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="content">
		<div class="container-fluid">
			<a href="?red=delFi" class="btn btn-danger">Deletar ficha</a>
		</div>
</div>





