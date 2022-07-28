<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form-validation.css">
    <link rel="stylesheet" href="css/admin.css">

    <title>Administrador</title>

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

        .erro{
            text-align: center;
            padding: .3rem;
            animation:  verificar ease-in-out 2s forwards;
            border-radius: 2px;
            font-size: 12.5pt;
            color: white;
            margin-top: -19.8px;
            margin-left: 30px;
            position:absolute;
        }

        @media  screen and (max-device-width: 957px) {
            ico{
                display:none;
            }
        }
    </style>
</head>

<body>
    <nav>
        <ul id = "menu">
            <li><a  href="Usuario_Log.php">Voltar</a></li>
        </ul>
    </nav>
  
    <div class="contentor">
        <?php 
        // VALIDACAO DAS CREDENCIAS DO ADMINISTRADOR
            if(isset($_SESSION['login-admin'])){
                echo $_SESSION['login-admin'];
                unset($_SESSION['login-admin']);
            }
        ?>
        <h2>Administrador</h2>
        <form action = "php/Main.php" method="POST" class="needs-validation" novalidate>
        <!-- FORMULARIO DE LOGIN DO ADMIN -->
            <div id="container">
                <input type="text" class="form-control" name="user" id="" autocomplete="off" placeholder="User" required  >
                <ico class = "user">A</ico>
            </div>
            <div id="container">
                <input type="password" class="form-control" name="senha" id="" placeholder="Password" required >
                <ico class = "pswd">L</ico>
            </div>
            <button name = "entrar" autofocus class="btn entrar">Entrar</button>
        </form>
    </div>
    <script src="js/form-validation.js"></script>
</body>

</html>