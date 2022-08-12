<?php session_start();?>

<!DOCTYPE html>
<html lang="pt">
</html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form-validation.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Novo Usuário</title>
    <style>
        .erro, .sucesso{
            text-align: center;
            padding: .3rem;
            animation:  verificar ease-in-out 2s forwards;
            border-radius: 2px;
            font-size: 12.5pt;
            color: white;
            margin-top:-20px;
        }
    </style>
</head>

<body>
    <nav>
        <ul id = "menu">
            <li><a href="Usuario_Log.php">Voltar</a></li>
        </ul>
   </nav>
    <div class="contentor">
    <?php 
        if(isset($_SESSION['newuser'])){
            echo $_SESSION['newuser'];
            unset($_SESSION['newuser']);
        }
    ?>
        <h2>Novo Usuário</h2>
        <form action = "php/Main.php" method="POST" class="needs-validation" novalidate>
        <p>Sexo
            <select name="sexo" id="sexo" class = "form-control" required>
            <option value="" disabled selected>Selecionar</option>
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
            </select>
        </p>
    
            <div id="container">
                <input type="text" class="form-control" name="nome" id="" placeholder = "Nome" required autocomplete="off">
            </div>

            <div id="container">
                <input type="email" class="form-control" name="email" id="" placeholder = "exemplo@gmail.com" required autocomplete="off">
            </div>

            <div id="container">
                <input type="password" class="form-control" name="password" id="" placeholder = "Password" required>
            </div>
                
            <div>
                <button name = "cadastrar" class="btn cadastrar">Cadastrar</button>
                <ico>S</ico>
            </div>
        </form>
    </div>
</body>
<script src="js/form-validation.js"></script>
</html>
