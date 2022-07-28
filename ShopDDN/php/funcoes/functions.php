<?php
//FUNCOES AUTOMATICAS
function verificarProdutos($conexao, $validade, $codigo){
     $dataActual = date("Y-m-d");
     foreach($conexao->query("SELECT * FROM Produtos WHERE Codigo = $codigo") as $img){
        if($validade <= $dataActual){
            $sql = $conexao->prepare("DELETE FROM Produtos WHERE Codigo = $codigo");
            $sql->execute();
    //APAGAR IMAGEM NO SERVIDOR
            $pasta = "img";
            if(is_dir($pasta)){
                $caminho = "$pasta/" . $img['Imagem'];
                unlink($caminho);
            }
        }
    }
}
function verificarBebidas($conexao, $validade, $codigo){
    $dataActual = date("Y-m-d");
    foreach($conexao->query("SELECT * FROM Bebidas WHERE Codigo = $codigo") as $img){
       if($validade <= $dataActual){
           $sql = $conexao->prepare("DELETE FROM Bebidas WHERE Codigo = $codigo");
           $sql->execute();
   //APAGAR IMAGEM NO SERVIDOR
           $pasta = "img";
           if(is_dir($pasta)){
               $caminho = "$pasta/" . $img['Imagem'];
               unlink($caminho);
           }
       }
   }
}
function verificarFrutas($conexao, $validade, $codigo){
    $dataActual = date("Y-m-d");
    foreach($conexao->query("SELECT * FROM Frutas WHERE Codigo = $codigo") as $img){
       if($validade <= $dataActual){
           $sql = $conexao->prepare("DELETE FROM Frutas WHERE Codigo = $codigo");
           $sql->execute();
   //APAGAR IMAGEM NO SERVIDOR
           $pasta = "img";
           if(is_dir($pasta)){
               $caminho = "$pasta/" . $img['Imagem'];
               unlink($caminho);
           }
       }
   }
}
function verificarCarnes($conexao, $validade, $codigo){
    $dataActual = date("Y-m-d");
    foreach($conexao->query("SELECT * FROM Carnes WHERE Codigo = $codigo") as $img){
       if($validade <= $dataActual){
           $sql = $conexao->prepare("DELETE FROM Carnes WHERE Codigo = $codigo");
           $sql->execute();
   //APAGAR IMAGEM NO SERVIDOR
           $pasta = "img";
           if(is_dir($pasta)){
               $caminho = "$pasta/" . $img['Imagem'];
               unlink($caminho);
           }
       }
   }
}
function pegarProdutos($conexao) {
	    $Produtos = array();

		$sql =  $conexao->query("SELECT * FROM Produtos");

		foreach($sql as $produto) {

		$Produtos[] = array(
			'ID' => $produto['Produtos_ID'],
            'Codigo' => $produto['Codigo'],
            'Imagem' => $produto['Imagem'],
			'Produto' => $produto['Produto'],
			'Descricao' => $produto['Descricao'],
            'Validade' => $produto['Validade'],
			'Preco' => $produto['Preco'],
		);
	}

	return $Produtos;
}
function pegarFrutas($conexao) {
    $frutas = array();

    $sql =  $conexao->query("SELECT * FROM Frutas");

    foreach($sql as $produto) {

    $frutas[] = array(
        'ID' => $produto['Frutas_ID'],
        'Codigo' => $produto['Codigo'],
        'Imagem' => $produto['Imagem'],
        'Produto' => $produto['Produto'],
        'Descricao' => $produto['Descricao'],
        'Validade' => $produto['Validade'],
        'Preco' => $produto['Preco'],
        );
    }

    return $frutas;

}
function pegarBebidas($conexao) {
    $bebidas = array();

    $sql =  $conexao->query("SELECT * FROM Bebidas");

    foreach($sql as $produto) {

    $bebidas[] = array(
        'ID' => $produto['Bebidas_ID'],
        'Codigo' => $produto['Codigo'],
        'Imagem' => $produto['Imagem'],
        'Produto' => $produto['Produto'],
        'Descricao' => $produto['Descricao'],
        'Validade' => $produto['Validade'],
        'Preco' => $produto['Preco'],
    );
    }

    return $bebidas;
}
function pegarCarnes($conexao) {
    $carnes = array();

    $sql =  $conexao->query("SELECT * FROM Carnes");

    foreach($sql as $produto) {

    $carnes[] = array(
        'ID' => $produto['Carnes_ID'],
        'Codigo' => $produto['Codigo'],
        'Imagem' => $produto['Imagem'],
        'Produto' => $produto['Produto'],
        'Descricao' => $produto['Descricao'],
        'Validade' => $produto['Validade'],
        'Preco' => $produto['Preco'],
    );
    }

    return $carnes;
}

function pagarCarrinho($conexao, $produtos, $descricao, $preco, $quantidade, $contacto, $nome, $pagamento, $subtotal, $total, $email, $endereco, $chave, $cliente){
    // PAGAR CARRINHO
                $sql = $conexao->prepare("INSERT INTO Carrinho (Produtos, Descricao, Preco, Quantidade, Contacto, Nome, Pagamento, Subtotal, Total, Email, Endereco, Chave, Cliente_FK) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $sql->bindValue(1, $produtos);
                $sql->bindValue(2, $descricao);
                $sql->bindValue(3, $preco);
                $sql->bindValue(4, $quantidade);
                $sql->bindValue(5, $contacto);
                $sql->bindValue(6, $nome);
                $sql->bindValue(7, $pagamento);
                $sql->bindValue(8, $subtotal);
                $sql->bindValue(9, $total);
                $sql->bindValue(10, $email);
                $sql->bindValue(11, $endereco);
                $sql->bindValue(12, $chave);
                $sql->bindValue(13, $cliente);
                $sql->execute();

                foreach($conexao->query("SELECT Data, Chave, Nome FROM Carrinho") as $d){
                    $_SESSION['chave'] = $d['Chave'];
                    $_SESSION['nome'] = $d['Nome'];
                    $_SESSION['dta'] = $d['Data'];
                    header("Location:/PagarCar.php");
                }
        } 
function pagaCarrinho($conexao, $produtos, $descricao, $preco, $quantidade, $contacto, $nome, $pagamento, $subtotal, $total, $nrconta, $email, $endereco, $chave, $cliente){
                
                $sql = $conexao->prepare("INSERT INTO Carrinho (Produtos, Descricao, Preco, Quantidade, Contacto, Nome, Pagamento, Subtotal, Total, NRConta, Email, Endereco, Chave, Cliente_FK) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $sql->bindValue(1, $produtos);
                $sql->bindValue(2, $descricao);
                $sql->bindValue(3, $preco);
                $sql->bindValue(4, $quantidade);
                $sql->bindValue(5, $contacto);
                $sql->bindValue(6, $nome);
                $sql->bindValue(7, $pagamento);
                $sql->bindValue(8, $subtotal);
                $sql->bindValue(9, $total);
                $sql->bindValue(10, $nrconta);
                $sql->bindValue(11, $email);
                $sql->bindValue(12, $endereco);
                $sql->bindValue(13, $chave);
                $sql->bindValue(14, $cliente);
                $sql->execute();

        foreach($conexao->query("SELECT Data, Chave, Nome FROM Carrinho") as $d){
            $_SESSION['chave'] = $d['Chave'];
            $_SESSION['nome'] = $d['Nome'];
            $_SESSION['dta'] = $d['Data'];
            header("Location:/PagarCar.php");
        }
}


function verNome($nome){
    //VERIFICAR O NOME
    $name = str_replace(" ", "", $nome);
    if(!ctype_alpha($name)){
        return false;
    }elseif(strlen($name) <= 1){
        return false;
    } else{
        return true;
    }
}

function verConta($numero){
    //VERIFICAR O TAMANHO DO NUMERO DA CONTA
    $conta = strval($numero);

    if(strlen($conta) != 16){
        return false;
    } elseif(!is_numeric($conta)){
        return false;
    } elseif(!substr($conta, 0, 1) === "4"){
        return false;
    } else{
        return true;
        }
}


function verContacto($numero){
    $telefone = strval($numero);
    //VERIFICAR O PREFIXO E TAMANHO DO CONTACTO
    if(strlen($telefone) != 9){
        return false;
    } elseif(!is_numeric($telefone)){
        return false;
    } else{
        if(substr($telefone, 0, 2) === "82" ||
        substr($telefone, 0, 2) === "83" ||
        substr($telefone, 0, 2) === "84" ||
        substr($telefone, 0, 2) === "85" ||
        substr($telefone, 0, 2) === "86" ||
        substr($telefone, 0, 2) === "87"){
            return true;
        } else{
            return false;
        }
    }
}

function verPagamento($pagamento, $num){
    // VERIFICAR O CONTACTO COM O TIPO DE PAGAMENTO
    $numero = strval($num);

    if(substr($numero, 0, 2) === "84" && $pagamento == "M-Pesa"){
        return true;
    } else if(substr($numero, 0, 2) === "85" && $pagamento == "M-Pesa"){
        return true;
    } else if(substr($numero, 0, 2) === "86" && $pagamento == "E-Mola"){
        return true;
    } else if(substr($numero, 0, 2) === "87" && $pagamento == "E-Mola"){
        return true;
    } else{
        return false;
    }
    
 }
?>