<?php

	class Ver_cpf{

		function validaCPF($cpf) {

			// Verifica se um número foi informado
			if(empty($cpf)) {
				return false;
			}

			// Elimina possivel mascara
			$cpf = preg_replace("/[^0-9]/", "", $cpf);
			$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
			
			// Verifica se o numero de digitos informados é igual a 11 
			if (strlen($cpf) != 11) {
				throw new Exception("<div class=' alert alert-danger' role='alert'>O numero de digitos do CPF não é valido</div>", 104);
				
			}
			// Verifica se nenhuma das sequências invalidas abaixo 
			// foi digitada. Caso afirmativo, retorna falso
			else if ($cpf == '00000000000' || 
				$cpf == '11111111111' || 
				$cpf == '22222222222' || 
				$cpf == '33333333333' || 
				$cpf == '44444444444' || 
				$cpf == '55555555555' || 
				$cpf == '66666666666' || 
				$cpf == '77777777777' || 
				$cpf == '88888888888' || 
				$cpf == '99999999999') {
				throw new Exception("<div class=' alert alert-danger' role='alert'>CPF invalido</div>", 105);
				;
			 // Calcula os digitos verificadores para verificar se o
			 // CPF é válido
			 // } else {   
				
				// for ($t = 9; $t < 11; $t++) {
					
				// 	for ($d = 0, $c = 0; $c < $t; $c++) {
				// 		$d += $cpf{$c} * (($t + 1) - $c);
				// 	}
				// 	$d = ((10 * $d) % 11) % 10;
				// 	if ($cpf{$c} != $d) {
				// 		throw new Exception("<div class=' alert alert-danger' role='alert'>CPF invalido</div>", 105);
						
				// 	}
				// }

				return true;
			}
		}
	}

?>