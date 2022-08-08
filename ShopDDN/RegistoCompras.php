<?php session_start();

    if(!isset($_SESSION['admin_id'])){
        header("Location:Administrador.php");
    }
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
<?php
    include ("php/Conexao.php");
    $sql = $conexao->query("SELECT Data FROM Compra WHERE Status = 0");
?>

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
            <li><a href="NovoProduto.php">Voltar</a></li>
            <li><a href="RegistoCarrinho.php">Registo de Carrinho</a></li>
        </ul>
   </nav>

    <div class="contentor">
    <h2>Registo de Compras</h2>
        <form action = "php/Main.php" method="POST" class="needs-validation" novalidate>
            <p>
                Data & hora
                <select name="data" id="data" class = "form-control" required>
                    <option selected disabled value = "">Selecione a data</option>
                <?php
                    foreach (($sql) as $row) {
                        echo "<option>" . $row['Data'] . "</option>";
                    }
               ?>
                </select>
            </p>
            <button name = "procurar" autofocus class="btn procurar">Procurar</button>
        </form>
           <p id = "result">
               <h3>Produto Requisitado</h3>
               <?php
               if(isset($_SESSION['produtos'])){
                   echo $_SESSION['produtos'];
                   unset ($_SESSION['produtos']);
               }
               ?>
           </p>

           <p id = "result2">
            <h3>Informacoes do Cliente</h3>
                <?php
                    if(isset($_SESSION['infos'])){
                        echo $_SESSION['infos'];
                        unset($_SESSION['infos']);
                    }
                ?>
        </p> 
        <a href="php/Confirma.php" class="btn">Confirmacao</a>
    </div>
    <script src="js/form-validation.js"></script>
</body>
</html>