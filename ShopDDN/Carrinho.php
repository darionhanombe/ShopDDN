<?php 
    session_start();
	require_once( "php/funcoes/cartoes.php");
    require_once("php/funcoes/functions.php");
	$conexao = require_once "php/CarConexao.php";

	if(isset($_GET['acao']) && in_array($_GET['acao'], array('add', 'del', 'up'))) {
		
		if($_GET['acao'] == 'add' && isset($_GET['codigo']) && preg_match("/^[0-9]+$/", $_GET['codigo'])){ 
			adicionar($_GET['codigo'], 1);
		}

		if($_GET['acao'] == 'del' && isset($_GET['codigo']) && preg_match("/^[0-9]+$/", $_GET['codigo'])){ 
			remover($_GET['codigo']);
		}

		if($_GET['acao'] == 'up'){ 
			if(isset($_POST['prod']) && is_array($_POST['prod'])){ 
				foreach($_POST['prod'] as $codigo => $quantidade){
						actualizar($codigo, $quantidade);
				}
			}
		} 
		header('Location:Carrinho.php');
	}

	$produtos = puxarProdutos($conexao);
	$totalProdutos  = pegarTotalProdutos($conexao);
?>

<?php
 if(isset($_POST['pagarCarrinho'])){
    //  EFECTUAR PAGAMENTO DO CARRINHO
    $contacto = addslashes($_POST['contacto']);
    $nome = addslashes($_POST['nome']);
    $pagamento = addslashes($_POST['pagamento']);
    $nrconta = addslashes($_POST['nrconta']);
    $email = addslashes($_POST['email']);
    $endereco = addslashes($_POST['endereco']);
    $total = addslashes($_POST['total']);
    $cliente = $_SESSION['cliente_id'];
    $n = rand(100, 1000);
    $chave = date('hi'.$n.'s');

     if(!verContacto($contacto)){
        $_SESSION['contacto'] = "<p class = 'erro'>Contacto Invalido!</p>";
    } else if(!verNome($nome)){
        $_SESSION['contacto'] = "<p class = 'erro'>Nome Invalido!</p>";
    } else{
        if($pagamento == "M-Pesa" || $pagamento == "Conta Movel" || $pagamento == "E-Mola"){
            if(!verPagamento($pagamento, $contacto)){
                $_SESSION['contacto'] = "<p class = 'erro'>Contacto Invalido para o metodo selecionado</p>";
            }else{
                foreach($produtos as $carrinho){
                    pagarCarrinho($conexao, $carrinho['Produto'], $carrinho['Descricao'], $carrinho['Preco'], $carrinho['Quantidade'], $contacto, $nome, $pagamento, $carrinho['SubTotal'], $total, $email, $endereco, $chave, $cliente);
                }
            }
        } else{
            if (!verConta($nrconta)) {
                $_SESSION['contacto'] = "<p class = 'erro'>Numero da conta invalido!</p>";
            } else {
                foreach($produtos as $carrinho){
                    pagaCarrinho($conexao, $carrinho['Produto'], $carrinho['Descricao'], $carrinho['Preco'], $carrinho['Quantidade'], $contacto, $nome, $pagamento, $carrinho['SubTotal'], $total, $nrconta, $email, $endereco, $chave, $cliente);
                }
            }
        }
    }

    unset($_SESSION['carrinho']);
 }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/carrinho.css">
    <link rel="stylesheet" href="css/form-validation.css">
    <title>Carrinho de Compras</title>
    <style>
        .erro, .sucesso{
            text-align: center;
            padding: .4rem;
            animation:  verificar ease-in-out 2s forwards;
            border-radius: 2px;
            font-size: 12.5pt;
        }

        .erro{
            background-color: rgb(255, 0, 0);
        }

        .sucesso{
            background-color: rgb(87, 247, 47);
        }

        @keyframes verificar{
            0%{
                opacity: 1;
            }
            80%{
                opacity: 0.8;
            }
            100%{
                opacity: 0;
            }
}
    </style>
</head>
<body>
<main>
    <div class="container-content">
        <div id = "content">
            <h3>Carrinho de Compra</h3>
            <div id = "add">
                <a href = "Produtos.php">+ Produtos</a>
            </div>
        </div>
    </div>
<?php 
// VALIDACAO DO CONTACTO
    if(isset($_SESSION['contacto'])){
        echo $_SESSION['contacto'];
        unset($_SESSION['contacto']);
    }
?>
<?php if($produtos) : ?>
<form action="Carrinho.php?acao=up" class = "needs-validation" method="POST" novalidate>
    <div id = "tabela">
        <table id = "tabela_carrinho">
            <tr>
                <th>Produto</th><th>Descricao</th><th>Quantidade</th><th>Preço/Unit</th><th>Sub-Total</th><th>Remover</th>
            </tr>
            <?php foreach($produtos as $result) { ?>
            <tr>	
                <td class = "colunas"><?php echo $result['Produto']?></td>
                <td class = "colunas"><?php echo $result['Descricao']?></td>
                <td class = "colunas col-qtd"><input type="number" name="prod[<?php echo $result['Codigo']?>]" value="<?php echo $result['Quantidade'] ?>" id = "qtd" placeholder = "Units" auto-complete = "off" size = '1' maxlength = '3' required></td>
                <td class = "colunas"><?php echo $result['Preco']?></td>
                <td class = "colunas"><?php echo $result['SubTotal']?></td>
                <td class = "btn-remover"><a href="Carrinho.php?acao=del&codigo=<?php echo $result['Codigo']?>"><img src="icons/remover.png" alt="Remover" title = "Remover"></a></td>
			</tr>

            <?php } ?> 
         
        <tr>
            <td class = "col-total">--</td>
            <td class = "col-total">--</td>
            <td class = "col-total">--</td>
            <td class = "col-total"><b>Total</b></td>
            <td class = "col-total"> <?php echo $totalProdutos ."MT"?></td>
        </tr>
        </table>
    </div>

<div id = "atualizar-carrinho">
    <button type="submit"><img src="/icons/up.png" alt="Actualizar Carrinho" title = "Actualizar Carrinho"></button>
</div>

</form>
<?php endif;?>
<div id = "btn">
    <input class = "btn-comprar" type="button" onclick  = "mostrar()" value="Pagar Carrinho">
</div>

<div class="popup" id="popup">
            <div class="popup-content">
            <h4>Pagar Carrinho</h4>
                <span class="fecha" onclick="fechar()">&times;</span>
                <form  method="POST" class="needs-validation" novalidate>
                    <!-- FORMULARIO  DE PAGAMENTO -->
                    <label id="lbl" for="pagamento">Pagamento</label><br>
                    <select name="pagamento" id="pagamento" class = "form-control" required>
                    <option value = "" disabled selected>Metodo</option>
                        <option value="Millenium Bim">Millenium Bim</option>
                        <option value="BCI">BCI</option>
                        <option value="Absa">Absa</option>
                        <option value="M-Pesa">M-Pesa</option>
                        <option value="E-Mola">E-Mola</option>
                        <option value="Conta Movel">Conta Movel</option>
                    </select>

                    <!-- INPUT HIIDEN's QUE RECEBE O TOTAL DOS PRODUTOS-->
                    <input type="hidden" name="total" value = "<?php echo $totalProdutos?>">

                    <label for="contacto">Contacto</label><br>
                    <input type="number" class="form-control" name="contacto" id="contacto" maxlength="9" placeholder = "+258"
                        required>

                    <?php if(isset($_SESSION['usuario'])) {
                        $nome = $_SESSION['usuario'] ; ?>

                    </br>
                        <label for="nome">Nome</label><br>
                        <input type="text" autocomplete="off" class="form-control" name="nome" id="nome" value = "<?php echo $nome?>" maxlength="60" required>

                    <?php } else {?>

                        </br>
                        <label for="nome">Nome</label><br>
                        <input type="text" autocomplete="off" class="form-control" name="nome" id="nome" maxlength="60" required>

                    <?php } ?>

                    <br>
                    <label for="conta">Numero da Conta</label><br>
                    <input type="number" class = "fr" name="nrconta" id="conta" maxlength="13">

                    <?php if(isset($_SESSION['usuario'])) {
                        $email = $_SESSION['email'] ; ?>

                    </br>
                    <label for="email">Email</label><br>
                    <input type="email" autocomplete="off" class="form-control" name="email" id="email" value = "<?php echo $email?>" maxlength="40" required>

                    <?php } else {?>
                        
                    </br>
                    <label for="email">Email</label><br>
                    <input type="email" autocomplete="off" class="form-control" name="email" id="email" maxlength="40" required>

                    <?php } ?>

                    <br>
                    <label for="endereco">Endereco</label><br>
                    <input type="text" autocomplete="off" class="form-control" name="endereco" id="endereco" maxlength="20" required>
                    <br>
                    
                    <button name = "pagarCarrinho" id="confirmar_compra" onclick = "mostrar()">Confirmar</button>
                </form>
  
            </div>
        </div>
</main> 

</body>
    <script src = "js/form-validation.js"></script>
    <script src = "js/funcoes.js"></script>
    <script src = "jquery/jquery.min.js"></script>

<script>
        $("#pagamento").change(function() {
    // PASSAR O REQUIRED PARA O INPUT[NUMERO DA CONTA] CASO SEJA SELECIONADO O METODO QUE EXIJA O NUMERO DA CONTA
        if (this.value == "Millenium Bim" || this.value == "BCI" || this.value == "Absa") {
            $('#conta').attr('required','required');
        } else{
            $("#conta").removeAttr('required', '')
        }
        });
    </script>
</html>
