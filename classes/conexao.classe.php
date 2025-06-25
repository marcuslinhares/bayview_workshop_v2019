<?php
    class Conexao {
    	public $pdo;
    	public function conecta (){
    		try {
    			$pdo = new PDO("mysql:host=localhost; dbname=id11697272_bayview_workshop_db", "id11697272_bayview", "workshop");
    			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    			$pdo->exec("set names utf8");
    		} catch (PDOException $erro) {
    			echo "Erro na conexão:" . $erro->getMessage();
    		}
    		return $pdo;
    	}
    
    }
?>