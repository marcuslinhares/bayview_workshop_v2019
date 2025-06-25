<?php
	session_start();
	if(!isset($_SESSION['user'])){
	    echo"<script>location.href='../index.php';</script>";
		session_destroy();
	}
	
	if (isset($_GET['sair'])) {
		session_destroy();
		header('location:../index.php');
	}
    include('../classes/conexao.classe.php');
    $pdo = new Conexao;
    $pdo = $pdo->conecta();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/imagens/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/imagens/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Beyview Workshop</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="../assets/imagens/capa.jpg">
        	<div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                      Bayview Workshop
                    </a>
                </div>
                <ul class='nav'>
					<?php
						if ($_SESSION['user']==0) {
							echo "<li class='nav-item active'>
										<a class='nav-link' href='?red=cadastroFi'>
											<i class='nc-icon nc-icon nc-chart-pie-35'></i>
											<p>cadastrar nova ficha</p>
										</a> 
									</li>	
									<li class='nav-item active'>
										<a class='nav-link' href='?red=verC'>
											<i class='nc-icon nc-icon nc-paper-2'></i>
											<p>visualizar clientes</p>
										</a>
									</li>	
									<li class='nav-item active'>
										<a class='nav-link' href='?red=verCar'>
											<i class='nc-icon nc-icon nc-paper-2'></i>
											<p>visualizar carros</p>
										</a>
									</li>";
						}else{
							echo "<li class='nav-item active'>
										<a class='nav-link' href='?red=cadastroF'>
											<i class='nc-icon nc-icon nc-paper-2'></i>
											<p>novo funcionario</p>
										</a>
									</li>	
								<li class='nav-item active'>
										<a class='nav-link' href='?red=verF'>
											<i class='nc-icon nc-icon nc-paper-2'></i>
											<p>ver funcionarios</p>
										</a>
									</li>	
								<li class='nav-item active'>
										<a class='nav-link' href='?red=verR'>
											<i class='nc-icon nc-icon nc-paper-2'></i>
											<p>relatorios</p>
										</a>
								</li>";
						}
					?>
				</ul>
			</div>
		 </div>
		 <div class="main-panel">
		 	 <nav class="navbar navbar-expand-lg " color-on-scroll="500"  >
                <div class="container-fluid" >
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    	<ul class="nav navbar-nav mr-auto">
	                    	<li class="nav-item">
	                            <a class="nav-link" href="?sair">
	                                <span class="no-icon">Sair desta conta</span>
	                            </a>
	                        </li>
                    	</ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="section">
				        <?php
							if (isset($_GET['red']) && $_GET['red']=='cadastroFi'){
								include('form_cadastro.php');
							}
							if (isset($_GET['red']) && $_GET['red']=='verC'){
								include('verC.php');
							}
							if (isset($_GET['red']) && $_GET['red']=='verFi') {
								include('verFi.php');
							}
							if (isset($_GET['red']) && $_GET['red']=='updC') {
								include('updC.php');
							}
							if (isset($_GET['red']) && $_GET['red']=='verCar'){
								include('verCar.php');
							}	
							if (isset($_GET['red']) && $_GET['red']=='updCar'){
								include('updCar.php');
							}			
							if (isset($_GET['red']) && $_GET['red']=='cadastroF'){
								include('form_cad_func.php');
							}
							if (isset($_GET['red']) && $_GET['red']=='verF'){
								include('verF.php');
							}
							if (isset($_GET['red']) && $_GET['red']=='updF') {
								include('updF.php');
							}
							if (isset($_GET['red']) && $_GET['red']=='delF') {
								include('delF.php');
							}
							if (isset($_GET['red']) && $_GET['red']=='verR') {
								include('verR.php');
							}
							if (isset($_GET['red']) && $_GET['red']=='delFi') {
								include('delFi.php');
							}
							if (!isset($_GET['red'])) {
								echo '
								    <div class="main-panel">
								    	<div class="container-fluid" >
											<div class="bd-example">
											    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
												    <ol class="carousel-indicators">
												      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
												      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
												      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
												    </ol>
											    <div class="carousel-inner">
											      	<div class="carousel-item active">
												        <img src="../assets/imagens/ba.jpg" class="d-block w-100" alt="...">
												        <div class="carousel-caption d-none d-md-block">
												          <h5>Seja bem vindo</h5>
												          <p>O sistema conta com crud de funcionarios.</p>
												        </div>
											        </div>
											        <div class="carousel-item">
												        <img src="../assets/imagens/ba2.jpeg" class="d-block w-100" alt="...">
												        <div class="carousel-caption d-none d-md-block">
												          <h5>Seja bem vindo</h5>
												          <p>O sistema conta com crud de clientes.</p>
												        </div>
											        </div>
											        <div class="carousel-item">
												        <img src="../assets/imagens/ba3.jpg" class="d-block w-100" alt="...">
												        <div class="carousel-caption d-none d-md-block">
												          <h5>Seja bem vindo</h5>
												          <p>O sistema conta com crud de carros.</p>
												        </div>
											        </div>
											    </div>
											    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
											        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
											        <span class="sr-only">Previous</span>
											    </a>
											    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
											        <span class="carousel-control-next-icon" aria-hidden="true"></span>
											        <span class="sr-only">Next</span>
											    </a>
											    </div>
											</div>
										</div>
									</div>
								';
							}
						?>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav> 
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a>Bayview Workshop</a>, no machine can do the work of a determined man.
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
</body>
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/jquery.mask.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<script src="../assets/js/plugins/chartist.min.js"></script>
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<script src="../assets/js/demo.js"></script>
</html>
