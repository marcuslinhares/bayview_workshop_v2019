<?php
	class Conexao {
		public $pdo;
	
		public function conecta (){
			try {
				$host = getenv("DB_HOST") ?: "localhost";
				$dbname = getenv("DB_NAME") ?: "id11697272_bayview_workshop_db";
				$user = getenv("DB_USER") ?: "id11697272_bayview";
				$pass = getenv("DB_PASS") ?: "workshop";
	
				$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->exec("set names utf8");
			} catch (PDOException $erro) {
				echo "Erro na conexão: " . $erro->getMessage();
			}
			return $pdo;
		}
	}
?>
