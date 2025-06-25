<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card strpied-tabled-with-hover">
					<div class="card-header ">
					 	<h4 class="card-title">Tabela com todos os clientes do sistema</h4>
					</div>
					 <div class="card-body table-full-width table-responsive">
						<table class="table table-hover table-striped">
							<thead>
								<th>id</th>
								<th>nome</th>
								<th>cpf</th>
								<th>telefone</th>
								<th>cidade</th>
								<th>ações</th>
							</thead>
							<tbody>
								<?php
                                    try{
               	                        include("../classes/clientes.classe.php");
        								$clientes = new Clientes($pdo);
        								$clientes-> read(); 
                                    }catch(Exception $e){
	                                	echo $e->getMessage();
	                                }
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

