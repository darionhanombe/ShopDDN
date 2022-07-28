<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form-validation.css">
    <title>Login</title>
    <style>
        /* ICONES DOS INPUT'S */
        .email{
            font-size: 1.5rem;
            opacity: 0.7;
            top: 5.2rem;
            left: 3.2rem;
            position:fixed;
        }

        .senha{
            font-size: 1.5rem;
            opacity: 0.7;
            top: 8.3rem;
            left: 3.2rem;
        }
        
        .erro{
            text-align: center;
            padding: .3rem;
            animation:  verificar ease-in-out 2s forwards;
            border-radius: 2px;
            font-size: 12.5pt;
            color: white;
            margin-top: -19.8px;
            margin-left: 40px;
            position:absolute;
        }
        
        @media screen and (max-device-width: 957px) {
            ico{
                display:none;
            }

            .erro{
                padding: .2rem;
                font-size: 10pt;
                margin-top: -9px;
                margin-left: 50px;
            }
        }
        </style>
</head>

<body>
    <nav>
        <ul id = "menu">
            <li><a href="Produtos.php">Voltar</a></li>
        </ul>
   </nav>
    <div class="contentor">
       <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
       ?>
        <h2>Login</h2>
        <form action = "php/Main.php" method="POST" class="needs-validation" novalidate>
            <div id="container">
                <input type="email" class="form-control" name="email" id="" autocomplete="off" placeholder="exemplo@gmail.com" required >
                <ico class = "email">E</ico>
            </div>
            <div id="container">
                <input type="password" class="form-control" name="senha" id="" placeholder="Senha" required >
                <ico class = "senha">L</ico>
            </div>
            <button name = "confirmar" autofocus class="btn confirmar">Confirmar</button>
        </form>

        <div class = "novaconta">
            <a href="NovoUsuario.php">Criar Conta</a>
        </div>

        <div class = "admin">
            <p>Entrar como <a href="Administrador.php"> Admin</a></p>
        </div>
    </div>

    <script src="js/form-validation.js"></script>

</body>
</html>