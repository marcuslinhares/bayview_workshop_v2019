<?php 

	class Relatorios {

		private $pdo;

		function __construct($arg){
			$this->pdo=$arg;
		}
		
		function relatorio(){
			try{
				
        		$stmt = $this->pdo->prepare("select f.nome, qs.quant_serv from funcionario as f join quantidade_servico as qs on f.id_funcionario=qs.funcionario_id_funcionario order by qs.quant_serv desc;");

        		if($stmt->execute()){
        			if ($stmt->rowCount() > 0) {
        				$a=0;
        				while ($rs=$stmt->fetch(PDO::FETCH_OBJ)) {
        					$a++;
	        				echo "<tr>";
	        				echo "<td>".$a."</td><td>".$rs->nome."</td><td>".$rs->quant_serv."</td><td>";
	        				echo "</tr>";
        				}
        			}
        		}else{
        			echo "Erro: nao foi possivel recuperar os dados do bd";
        		}

        	}catch(PDOException $erro) {

				echo "Erro: ".$erro->getMessage();

			}
			
		}

	}

?>