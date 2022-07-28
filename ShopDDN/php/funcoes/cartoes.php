<?php 
function pegarProdutosPeloID($conexao, $Codigo) {
	$sql = "SELECT * FROM (SELECT * FROM Bebidas UNION ALL SELECT * FROM Produtos UNION ALL SELECT * FROM Frutas UNION ALL SELECT * FROM Carnes) RES WHERE Codigo IN (".$Codigo.")";
	$pstm = $conexao->prepare($sql);
	$pstm->execute();
	return $pstm->fetchAll(PDO::FETCH_ASSOC);
}


if(!isset($_SESSION['carrinho'])) {
	$_SESSION['carrinho'] = array();
}

function adicionar($codigo, $quantidade) {
	if(!isset($_SESSION['carrinho'][$codigo])){ 
		$_SESSION['carrinho'][$codigo] = $quantidade; 
	}
}

function remover($codigo) {
	if(isset($_SESSION['carrinho'][$codigo])){ 
		unset($_SESSION['carrinho'][$codigo]); 
	} 
}

function actualizar($codigo, $quantidade) {
	if(isset($_SESSION['carrinho'][$codigo])){ 
		if($quantidade > 0) {
			$_SESSION['carrinho'][$codigo] = $quantidade;
		} else {
		 	remover($codigo);
		}
	}
}

function puxarProdutos($conexao) {
	$results = array();

	if($_SESSION['carrinho']) {
		
		$carrinho = $_SESSION['carrinho'];
		$produtos =  pegarProdutosPeloID($conexao, implode(',', array_keys($carrinho)));

		foreach($produtos as $produto) {

			$results[] = array(
							  'Codigo' => $produto['Codigo'],
							  'Produto' => $produto['Produto'],
							  'Descricao' => $produto['Descricao'],
							  'Preco' => $produto['Preco'],
							  'Quantidade' => $carrinho[$produto['Codigo']],
							  'SubTotal' => $carrinho[$produto['Codigo']] * $produto['Preco'],
							   
						);
		}
	}

	return $results;
}


function pegarTotalProdutos($conexao) {
	
	$total = 0;

	foreach(puxarProdutos($conexao) as $produto) {
		$total += $produto['SubTotal'];
	} 

	return $total;
}