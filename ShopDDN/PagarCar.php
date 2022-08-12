<?php
require_once("php/Conexao.php");
session_start();

if(!isset($_SESSION['chave'])){
    header("Location:Produtos.php");
}

$chave = $_SESSION['chave'];
$sql = $conexao->query("SELECT Produtos, Nome, Descricao, Preco, Quantidade, Subtotal FROM Carrinho WHERE Chave = $chave");
$cont = $conexao->query("SELECT COUNT(*) FROM Carrinho WHERE Chave = $chave");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/recibo.css">
    <title>Recibo</title>
    <style>
        th, td{
            border: solid rgb(0, 0, 0, 0.1);
            border-width:1px;
            padding:5px;
            font-size : 11pt;
        }

        .requisita{
            text-align:center;
            font-size:13pt;
        }

        .produtos{
            text-align:center;
        }
    </style>
</head>
<body>
<section class="recibo" id = "recibo">
        <div id = "recibo-content">
            <h2>ShopDDN</h2>
        <span class = "tit-recibo">Recibo</span>
        <div id = "conteudo-recibo">
            Data e Hora : 
            <?php 
                if(isset($_SESSION['dta'])){
                    echo $_SESSION['dta'];
                }
            ?>
            
            <P>Cliente : <span><strong>
                <?php
                    if(isset($_SESSION['nome'])){
                        echo $_SESSION['nome'];
                    }
                ?>
                </strong></span>
            </P>
            <p>
            <p class = "requisita"><strong> Compra Efectuada com Sucesso!</strong>
            <p>Pagou <?php
                foreach($cont as $n){
                    echo $n[0];
                }
            ?>  produtos.</p>
               
            <table class = "produtos">
                    <th>Produto</th> <th>Descrição</th> <th>Qtd</th> <th>Preço</th>
                    <?php foreach ($sql as $res) {?>
                        <tr>
                            <td><?php echo $res['Produtos'] ?></td>
                            <td><?php echo $res['Descricao']?></td>
                            <td><?php echo $res['Quantidade']?></td>
                            <td><?php echo $res['Preco']?></td>
                        </tr>
                        <?php } ?>
                    
                        <tr>
                            <td>TOTAL</td>
                            <td>--</td>
                            <td>--</td>
                            <td><strong><?php 
                            foreach($conexao->query("SELECT Total FROM Carrinho WHERE Chave = $chave LIMIT 1") as $tot){
                                echo $tot['Total'];
                            }
                            ?> MT</strong></td>
                        </tr>
            </table>
            </p>
            <br>Os seus produtos serão entregues dentro de 2 dias! Obrigado. Continue desfrutando dos nossos produtos.</p>
        </div>
            <div id = "btn-ok">
                <a href="Produtos.php" id = "btn-recibo" name = "fechar">FECHAR</a>
                <a href="php/PDFCarrinho.php" id = "baixar-recibo"><img class = "i-recibo" src="icons/download-direto.png" alt="Baixar Recibo" title = "Baixar Recibo"></a>
            </div>

        </div>
</section>
</body>
</html>