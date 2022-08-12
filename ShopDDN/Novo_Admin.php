<?php session_start();

$tipo = $_SESSION['admin_tipo'];
if(!isset($_SESSION['admin_id']) OR !$tipo){
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
<title>Novo Administrador</title>
<style>
        /* ICONES DOS INPUT'S */
        .user{
            font-size: 1.5rem;
            opacity: 0.7;
            top: 5.2rem;
            left: 3.2rem;
            position:fixed;
        }

        .pswd{
            font-size: 1.5rem;
            opacity: 0.7;
            top: 8.3rem;
            left: 3.2rem;
        }

        .erro, .sucesso{
            text-align: center;
            padding: .3rem;
            animation:  verificar ease-in-out 2s forwards;
            border-radius: 2px;
            font-size: 12.5pt;
            color: white;
            margin-top: -19.8px;
            margin-left: 42px;
            position:absolute;
        }
    </style>
</head>

<body>
<div id = "user">
<a name = "sair" class = "sair" href="php/logout.php"><img src="icons/msd.png" alt="Terminar Sessão" title = "Terminar Sessão e Sair"></a>
    <p>
        <?php
            echo $_SESSION['perfil'];
        ?>
    </p>
</div>

<nav>
    <ul id = "menu">
        <li><a href="NovoProduto.php">Voltar</a></li>
    </ul>
</nav>
<div class="contentor">
        <?php 
            if(isset($_SESSION['addadmin'])){
                echo $_SESSION['addadmin'];
                unset($_SESSION['addadmin']);
            }
        ?>
        <h2>Novo Administrador</h2>
        <form action = "php/Main.php" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
        
            <div id="container">
                <input type="text" class="form-control" name="user" id="" placeholder = "User" required autocomplete="off">
            </div>

            <div id="container">
                <input type="password" class="form-control" name="password" id="" placeholder = "Password" required>
            </div>
            <div id="container">
            <input type="file" accept = "image/jpg, image/png" class = "form-control" name="imagem" id="imagem" required>
                <label for="imagem" id = "label-img-produto">
                    <span class = "nome_imagem">Selecionar imagem de perfil</span>
                    <span>Carregar</span>
                </label>
            </div>
            <div>
                <button name = "add-novoadmin" class="btn cadastrar">Adicionar</button>
            </div>
        </form>
    </div>
    <script src="js/form-validation.js"></script>
    <script>
    document.querySelector("#imagem").addEventListener("change", function () {//PASSA O NOME DA IMAGEM PARA O INPUT FILE
    document.querySelector(".nome_imagem").textContent = this.files[0].name
    })
    </script>
</body>

</html>