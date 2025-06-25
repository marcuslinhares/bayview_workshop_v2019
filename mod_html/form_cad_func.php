<div class="row">
    <div class="col-md-8 ml-auto mr-auto">
        <div class="card">
        	<div class="header text-center">
        		<h4 class="title">Cadastro de funcionario</h4>
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
								throw new Exception("<div class=' alert alert-danger' role='alert'>O campo telefone é obrigatório.</div>", 101);
							}

							if(isset($_POST['cidade']) AND !empty($_POST['cidade'])){
								$cidade = $_POST['cidade'];
							} else{
								throw new Exception("<div class=' alert alert-danger' role='alert'>O campo cidade é obrigatório.</div>", 101);
							}

							if(isset($_POST['senha']) AND !empty($_POST['senha'])){
								$senha = $_POST['senha'];
							} else{
								throw new Exception("<div class=' alert alert-danger' role='alert'>O campo senha é obrigatório.</div>", 101);
							}

							include("../classes/ver_cpf.classe.php");
							$ver_cpf = new Ver_cpf();
							$ver_cpf-> validaCPF($cpf);

							include("../classes/ver_telefone.classe.php");
							$ver_telefone = new Ver_telefone();
							$ver_telefone-> validaTelefone($telefone);

							include("../classes/funcionarios.classe.php");
							$funcionarios = new Funcionarios($pdo);
							$funcionarios-> readunicadver($cpf);
							$funcionarios->create($nome, $cpf, $telefone, $cidade, $senha);

						}catch(Exception $e){
							echo $e->getMessage();
						}
					}
				?>
			</div>
				<form action="?red=cadastroF&act=save" method="POST" name="form_cadastro">
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo">
					</div>
					<div class="form-group">
						<label for="cpf">cpf</label>
						<input type="text" class="form-control" id="cpf" data-mask='000.000.000-00' name="cpf" placeholder="Digite o cpf">
					</div>						
					<div class="form-group">
						<label for="telefone">telefone</label>
						<input type="text" class="form-control" id="telefone" data-mask='00000-0000' name="telefone" placeholder="Digite o telefone">
					</div>
					<div class="form-group">
						<label for="cidade">Cidade</label>
						<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Digite a cidade">
					</div>
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="text" class="form-control" id="senha" name="senha" placeholder="Digite a senha">
					</div>

					<input type="submit" value="salvar" class="btn btn-primary">
					<input type="reset" value="novo" class="btn btn-primary">
				</form>
				<br>
			</div>
			
		</div>
	</div>
</div>

