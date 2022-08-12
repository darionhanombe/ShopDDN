<?php 
session_set_cookie_params(300);
session_start();

if(!isset($_SESSION['result-data'])){
    header("Location:Produtos.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/recibo.css">
    <title>Recíbo</title>

    <style>
        p{
            margin:5px;
        }
    </style>
</head>
<body onload="ViewTime()">
    <section class="recibo" id = "recibo">
        <div id = "recibo-content">
        <h2>ShopDDN</h2>
        <span class = "tit-recibo">Recibo</span>
        <div id = "conteudo-recibo">
            <?php  if (isset($_SESSION['result-data'])) { ?>
                   <strong>Data & Hora : </strong><?php echo $_SESSION['result-data'] ?>
            <?php } ?>
            </span></p>

            <?php  if (isset($_SESSION['result-compra-nome'])) { ?>
                   <p><strong>Cliente : </strong><?php echo $_SESSION['result-compra-nome'] ?></p>
            <?php } ?>

            <?php  if (isset($_SESSION['result-compra-produto'])) { ?>
                   <p><strong>Produto : </strong><?php echo $_SESSION['result-compra-produto'] ?></p>
            <?php } ?>

            <?php  if (isset($_SESSION['result-compra-descricao'])) { ?>
                   <p><strong>Descricao : </strong><?php echo $_SESSION['result-compra-descricao'] ?></p>
            <?php } ?>

            <?php  if (isset($_SESSION['result-compra-preco'])) { ?>
                   <p><strong>Preco : </strong><?php echo $_SESSION['result-compra-preco'] ?> MT</p>
            <?php } ?>

            <?php  if (isset($_SESSION['result-compra-qtd'])) { ?>
                   <p><strong>Quantidade : </strong><?php echo $_SESSION['result-compra-qtd'] ?></p>
            <?php } ?>

            <?php  if (isset($_SESSION['result-compra-total'])) { ?>
                   <p><strong>TOTAL: </strong><?php echo $_SESSION['result-compra-total'] ?><strong>MT</strong></p>
            <?php } ?>

            <p class = "requisita"><strong>Compra Efectuada com Sucesso!</strong>
            <br> O seu produto será entregue dentro de 2 dias! Obrigado. Continue desfrutando dos nossos produtos.</p>
        </div>
            <div id = "btn-ok">
                <a href="Produtos.php" id = "btn-recibo">FECHAR</a>
                <a href="php/gerarPDF.php" id = "baixar-recibo"><img class = "i-recibo" src="icons/download-direto.png" alt="Baixar Recibo" title = "Baixar Recibo"></a>
            </div>

        </div>
    </section>

    <script src="js/Horas.js"></script>

</body>
</html>
