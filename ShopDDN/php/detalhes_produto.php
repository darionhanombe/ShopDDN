<?php
require_once("Conexao.php");
if(isset($_POST["cod_produto"])){
    
    $cod_produto = $_POST["cod_produto"];
	
	$detalhes = '';

	
    $sql_detalhes = $conexao->query("SELECT Codigo, Produto, Descricao, Preco FROM (SELECT Codigo, Produto, Descricao, Preco FROM Bebidas UNION ALL SELECT Codigo, Produto, Descricao, Preco FROM Produtos UNION ALL SELECT Codigo, Produto, Descricao, Preco FROM Frutas UNION ALL SELECT Codigo, Produto, Descricao, Preco FROM Carnes) RES WHERE Codigo = $cod_produto LIMIT 1");
    
    foreach($sql_detalhes as $row){
        $detalhes .= "<input type = 'hidden' name = 'cod_produto' value = '$row[Codigo]'>";
        $detalhes .=  "<p><span>Nome</span>$row[Produto]</p>";
        $detalhes .=  "<p><span>Descricao</span>$row[Descricao]</p>";
        $detalhes .=  "<p><span>Preco Actual</span>$row[Preco]MT</p>";

    }
	echo $detalhes;  
}
    ?>