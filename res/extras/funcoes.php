<?php 

function exibeFuncao($funcao){
	if ($funcao == 'admin'){
		return 'Administrador';
	} else if ($funcao == 'op'){
		return 'Operador do Sistema';
	}
}

function qualSituacao($situacao){
	if ($situacao == 'ABERTO'){
		return 'success';
	} else if ($situacao == 'CLIENTE'){
		return 'danger';
	} else if ($situacao == 'SISTEMA'){
		return 'warning';
	} else if ($situacao == 'FECHADO'){
		return 'gray';
	}
}

function textoSituacao($situacao){
	if ($situacao == 'ABERTO'){
		return 'ABERTO';
	} else if ($situacao == 'CLIENTE'){
		return 'Aguardando cliente';
	} else if ($situacao == 'SISTEMA'){
		return 'Aguardando sistema';
	} else if ($situacao == 'FECHADO'){
		return 'FECHADO';
	}
}

function textoMotivo($motivo){
	if ($motivo == 'questao'){
		return 'Falar sobre uma questão';
	} else if ($motivo == 'financeiro'){
		return 'Setor Financeiro';
	} else if ($motivo == 'duvida'){
		return 'Dúvidas, críticas ou sugestões do Cliente';
	}
}

function exibeData($data){
	$p = explode('-', $data);
	return $p[2].'/'.$p[1].'/'.$p[0];
}

/*
	Retorna True se o CPF for verdadeiro
*/
function validaCPF ($cpf){

	if(empty($cpf)) {
        return false;
    }

    $cpf = str_replace(".", "", $cpf);
    $cpf = str_replace("-", "", $cpf);
    $cpf = preg_match('/[0-9]/', $cpf)?$cpf:0;
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    if (strlen($cpf) != 11) {
        return false;
    }
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
        return false;
    } else {   
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
              return false;
            }
        }
        return true;
    }
}

function mesParaFrente($qtd_mes){
	
}

/*
*	Gera os anos de validade para Cartão de Crédito (Padrão 14 anos)
*/
function geraAnosCartao(){

	$years = [];

	for ($y = date("Y"); $y < date("Y")+14; $y++){
		array_push($years, $y);
	}

	return $years;
}

 ?>