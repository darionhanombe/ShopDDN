<?php
session_start();
    require_once("php/Conexao.php");

    if(!isset($_SESSION['admin_id'])){
        header("Location:Administrador.php");
    }

    if(isset($_SESSION["registo_carrinho"])){
        $sql = $_SESSION["registo_carrinho"];
    }

    if(isset($_SESSION["dados"])){
        $dds = $_SESSION["dados"];
    }
    
    $data = $conexao->query("SELECT Data FROM Carrinho WHERE Status = 0");

?>
<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form-validation.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Registo de Compras</title>

</head>
<body>
    <div id = "user">
    <a name = "sair" class = "sair" href="php/logout.php"><img src="icons/msd.png" alt="Terminar Sessao" title = "Terminar Sessao e Sair"></a>

        <p>
            <?php
                echo $_SESSION['perfil'];
            ?>
        </p>
    </div>

    <nav>
        <ul id = "menu">
            <li><a href="RegistoCompras.php">Voltar</a></li>
        </ul>
   </nav>

    <div class="contentor">
    <h2>Registo de Compras pelo Carrinho</h2>
        <form action = "php/Main.php" method="POST" class="needs-validation" novalidate>
            <p>
                Data & hora
                <select name="data-carrinho" id="data" class = "form-control" required>
                    <option selected disabled value = "">Selecione a data</option>
                <?php
                    foreach ($data as $row) {
                        echo "<option>" . $row['Data'] . "</option>";
                    }
               ?>
                </select>
            </p>
            <button name = "procura" autofocus class="btn procurar">Procurar</button>
                </form>
                
                <p id  = "result2">
<h3>Informacoes do cliente</h3>
</p>
    <?php 
    if(isset($_SESSION["dados"])){

    foreach ($dds as $ds) {?>
       Cliente: <?php echo $ds['Nome']?>
       <br>Contacto: <?php echo $ds['Contacto']?>
       <br>Email: <?php echo $ds['Email']?>
       <br>Endereco: <?php echo $ds['Endereco']?>
       <br>Pagamento: <?php echo $ds['Pagamento']?>
       <br>Nr da Conta: <?php echo $ds['NRConta']?>
       <br>Data da Requisicao: <?php echo $ds['Data']?>
    <?php } }?>
    <p id  = "result2">
<h3>Produtos Requisitados</h3>
</p>
        <table class = "produtos">
            <th>Produto</th><th>Descrição</th><th>Qtd</th> <th>Preço</th><th>Sub-Total</th>
            <?php if(isset($_SESSION["dados"])){ ?>
            <?php foreach ($sql as $res) {?>
                        <tr>
                            <td><?php echo $res['Produto'] ?></td>
                            <td><?php echo $res['Descricao']?></td>
                            <td><?php echo $res['Quantidade']?></td>
                            <td><?php echo $res['Preco']?></td>
                            <td><?php echo $res['Subtotal']?></td>
                        </tr>
                        
                    <?php } }?>
                        <tr>
                            <td><strong>TOTAL</strong></td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td><strong><?php
                            if(isset($_SESSION["dados"])){ 
                            foreach($conexao->query("SELECT Total FROM Carrinho WHERE Chave = $res[Chave] LIMIT 1") as $tot){
                                echo $tot['Total'];
                                $_SESSION['ch'] = $tot['Total'];
                            }
                        }?> MT</strong></td>
                        </tr>
            </table>
        <a href="php/CarConfirm.php" class="btn">Confirmação</a>
    </div>
    <script src="js/form-validation.js"></script>
</body>
</html>