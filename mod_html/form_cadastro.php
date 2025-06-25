<div class="row">
    <div class="col-md-8 ml-auto mr-auto">
        <div class="card">
        	<div class="header text-center">
        		<h4 class="title">Cadastro de ficha do cliente</h4>
        		<p class="category">Preencha todos os campos possiveis.</p>
                <br>
            </div>
            <div class="container">
            	<div class="container">
            		<?php
						if (isset($_GET['act']) && $_GET['act']=='save') {

							try{
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
									throw new Exception("<div class=' alert alert-danger' role='alert'>O campo nome é obrigatório.</div>", 101);
								}

								if(isset($_POST['placa']) AND !empty($_POST['placa'])){
									$placa = $_POST['placa'];
								} else{
									throw new Exception("<div class=' alert alert-danger' role='alert'>O campo placa é obrigatório.</div>", 101);
								}

								if(isset($_POST['tipo']) AND !empty($_POST['tipo'])){
									$tipo = $_POST['tipo'];
								} else{
									throw new Exception("<div class=' alert alert-danger' role='alert'>O campo tipo é obrigatório.</div>", 101);
								}
								
								include("../classes/clientes.classe.php");
								$clientes = new Clientes($pdo);
								include("../classes/carros.classe.php");
								$carros = new Carros($pdo);
								include("../classes/servicos.classe.php");
								$servicos = new Servicos($pdo);
								
								include("../classes/ver_cpf.classe.php");
    							$ver_cpf = new Ver_cpf();
    							$ver_cpf-> validaCPF($cpf);
    
    							include("../classes/ver_telefone.classe.php");
    							$ver_telefone = new Ver_telefone();
    							$ver_telefone-> validaTelefone($telefone);

								$clientes-> readunicadver($cpf);
								$carros-> readunicadver($placa);

								$clientes->create($nome, $cpf, $telefone);

								$dadosCli = $clientes-> readunicad($cpf);

								$idCli=$dadosCli->id_cliente;

								$carros->create($idCli, $placa);

								$dadosCar = $carros-> readunicad($placa);

								$idCar=$dadosCar->idcarro;

								$idF=$_SESSION['idF'];

								$servicos = $servicos->create($idCar, $tipo, $idF);

							}catch(Exception $e){
								echo $e->getMessage();
							}
						}
					?>
					
				</div>
				<form action="?red=cadastroFi&act=save" method="POST" name="form_cadastro">
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome">
					</div>
					<div class="form-group">
						<label for="cpf">cpf</label>
						<input type="text" class="form-control" id="cpf" data-mask='000.000.000-00' name="cpf" placeholder="Digite seu cpf">
					</div>
					<div class="form-group">
						<label for="telefone">telefone</label>
						<input type="text" class="form-control" id="telefone" data-mask='00000-0000' name="telefone" placeholder="Digite seu telefone">
					</div>
					<div class="form-group">
						<label for="cidade">Cidade</label>
						<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Digite sua cidade">
					</div>
									
					<div class="form-group">
						<label for="placa">Placa do carro</label>
						<input type="text" class="form-control" id="placa" data-mask='AAA-0000' name="placa" placeholder="Digite a placa do carro">
					</div>
					<div class="form-group">
						<label for="modelo">Modelo do carro</label>
						<input type="text" class="form-control" id="modelo" name="modelo" placeholder="Digite o modelo do carro">
					</div>
					<div class="form-group">
						<label for="ano">Ano do carro</label>
						<input type="text" class="form-control" id="ano" data-mask='0000' name="ano" placeholder="Digite o ano do carro">
					</div>
					<div class="form-group">
			  			<label for="demo_overview">Selecione o serviço desejado</label>
						<select name="tipo" id="demo_overview" class="form-control" data-role="select-dropdown">
						  <option value="cambagem">cambagem</option>
						  <option value="troca de olho">troca de olho</option>
						  <option value="desenpeno de eixo">desenpeno de eixo</option>
						  <option value="limpeza">limpeza</option>
						</select>
					</div>

						<input type="submit" value="salvar" class="btn btn-primary">
						<input type="reset" value="novo" class="btn btn-primary">

				</form><br>
			</div>
		</div>
	</div>
</div>


