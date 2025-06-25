<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card strpied-tabled-with-hover">
					<div class="card-header ">
					 	<h4 class="card-title">Funcionario com maior eficiencia</h4>
					</div>
					 <div class="card-body table-full-width table-responsive">
						<table class="table table-hover table-striped">
							<thead>
								<th>Posição</th>
								<th>Nome</th>
								<th>Quantidade de serviços</th>
							</thead>
							<?php

								include("../classes/relatorios.classe.php");
								$relatorios = new Relatorios($pdo);
								$relatorios-> relatorio();

							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>