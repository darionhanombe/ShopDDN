<?php
session_start();

$tipo = $_SESSION['admin_tipo'];
if(!isset($_SESSION['admin_id']) OR !$tipo){
    header("Location:Administrador.php");
}
?>
<!DOCTYPE html>
<html lang="pt">
</html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form-validation.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Novo Produto</title>

    <style>
        .erro, .sucesso{
            text-align: center;
            padding: .3rem;
            animation:  verificar ease-in-out 2s forwards;
            border-radius: 2px;
            font-size: 12.5pt;
            color: white;
            position:absolute;
            margin-top: -19.5px;
            margin-left: 23px;
        }
    </style>
</head>

<body>
    <div id = "user">
            <a name = "sair" class = "sair" href="php/logout.php"><img src="icons/msd.png" alt="Terminar Sessão" title = "Terminar Sessao e Sair"></a>
        <p>
            <?php
                echo $_SESSION['perfil'];
            ?>
        </p>
    </div>
   <nav>
        <ul id = "menu">
            <li><a href="Produtos.php">Voltar</a></li>
            <li><a href="RegistoCompras.php">Registo de Compras</a></li>
            <li><a href="RegistoCarrinho.php">Registo de Carrinho</a></li>
            <li><a href="GerenciarProdutos.php">Gerenciar Produtos</a></li>
            <li><a href="Novo_Admin.php">Novo Administrador</a></li>
        </ul>
   </nav>

    <div class="contentor newproduto">
        <?php 
            if(isset($_SESSION['addproduto'])){
                echo $_SESSION['addproduto'];
                unset($_SESSION['addproduto']);
            }
        ?>
        <h2>Novo Produto</h2>
        <form action = "php/Main.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
        <p>Categoria 
            <select name="categoria" id="categoria" class = 'form-control' required>
                <option value = "" selected disabled>Selecionar</option>
                <option value="Frutas">Frutas</option>
                <option value="Produtos">Produtos</option>
                <option value="Carnes">Carnes</option>
                <option value="Bebidas">Bebidas</option>
            </select>
        </p>
        <div id="container">
            <input type="file" accept = "image/*" class = "form-control" name="imagem" id="imagem" required>
                <label for="imagem" id = "label-img-produto">
                    <span class = "nome_imagem">Selecionar imagem do produto</span>
                    <span>Carregar</span>
                </label>
            </div>
            
            <div id="container">
                <input type="text" class="form-control" name="produto" id="" placeholder = "Produto" required autocomplete="off">
            </div>

            <div id="container">
                <input type="text" class="form-control" name="descricao" id="" placeholder = "Descricao" required autocomplete="off">
            </div>

            <div id="container">
                <input type="number" class="form-control" name="preco" id="" placeholder = "Preco" required>
            </div>

             <p>Validade <input type="date" name="validade" id="validade"></p>
                
            <div>
                <button name = "adicionar" class="btn adicionar">Adicionar</button>
            </div>
        </form>
    </div>

</body>
<script src="js/form-validation.js"></script>
<script src = "js/funcoes.js"></script>
</html>
