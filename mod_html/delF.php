<?php
   
	if(isset($_POST['sim'])){
	    try{
    		include('../classes/funcionarios.classe.php');
    		$funcionarios = new Funcionarios($pdo);
    		$id = $_GET['id'];
    		$dados=$funcionarios->readunidell($id);
    		if($dados->nivel==1){
    			echo '<h5 class= btn btn-danger>Os dados do gerente não podem ser deletados.</h5>';
    		}else{
    			$funcionarios->delete($id);
    		}
	    }catch(Exception $e){
	       	echo $e;
	    }
	}
	if (isset($_POST['cancelar'])) {
	    echo"<script>location.href='../mod_html/inicial.php?red=verF';</script>";
	}
?>
<div class="col-md-8 ml-auto mr-auto">
    <div class="card">
    	<div class="header text-center">
    		<h4 class="title">Deseja realmente apagar os dados deste funcionario?</h4>
        </div>
        <div class="container" style="text-align: center;">
			<form method="POST" name="form_cadastro">
				<div class="contente">
					<input class="btn btn-success" type="submit" name="cancelar" value="cancelar">
					<input class="btn btn-danger" type="submit" name="sim" value="sim">
				</div>
			</form>
			<br>
		</div>
	</div>
</div>