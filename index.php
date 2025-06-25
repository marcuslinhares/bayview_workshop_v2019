<?php
	include("classes/conexao.classe.php");
	$pdo = new Conexao;
	$pdo = $pdo->conecta();
	
	if(isset($_SESSION['user'])){
	    header('location:mod_html/inicial.php');
	}
	
    if (isset($_GET['act']) && $_GET['act']=='logar') {
        try{
        	include("classes/ver_login.classe.php");
        	$verificador = new Verificador($pdo);
        	$verificador->verifica();
        }catch(Exception $e){
                                echo $e->getMessage();
                            }
                    	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bayview Workshop</title>
		<div id="dropDownSelect1"></div>
	<link rel="icon" type="image/png" href="assets/imagens/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fontes/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fontes/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="library/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="library/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="library/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="library/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="library/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/imagens/background.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Bayview Workshop
				</span>
				<form action="?act=logar" method="POST" class="login100-form validate-form p-b-33 p-t-5">
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" data-mask='000.000.000-00' name="cpf" placeholder="CPF do funcionario">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="senha" placeholder="senha">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>
					<?php

			        ?>
					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<script src="library/jquery/jquery-3.2.1.min.js"></script>
<script src="assets/js/jquery.mask.min.js" type="text/javascript"></script>
<script src="library/animsition/js/animsition.min.js"></script>
<script src="library/bootstrap/js/popper.js"></script>
<script src="library/bootstrap/js/bootstrap.min.js"></script>
<script src="library/select2/select2.min.js"></script>
<script src="library/daterangepicker/moment.min.js"></script>
<script src="library/daterangepicker/daterangepicker.js"></script>
<script src="library/countdowntime/countdowntime.js"></script>
<script src="assets/js/main.js"></script>
</html>