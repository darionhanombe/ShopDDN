<?php session_start();
require_once("php/Conexao.php");

$tipo = $_SESSION['admin_tipo'];
if(!isset($_SESSION['admin_id']) OR !$tipo){
    header("Location:Administrador.php");
}
$sql = $conexao->query("SELECT Codigo, Produto, Descricao, Preco FROM Produtos UNION ALL SELECT Codigo, Produto, Descricao, Preco FROM Frutas UNION ALL SELECT Codigo, Produto, Descricao, Preco FROM Bebidas UNION ALL SELECT Codigo, Produto, Descricao, Preco FROM Carnes ORDER BY Codigo");

?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form-validation.css">

    <title>Gerenciar Produtos</title>
    <style>
        h2.tt{
            margin-top:2rem;
        }
        .erro, .sucesso{
            text-align: center;
            padding: .3rem;
            animation:  verificar ease-in-out 2s forwards;
            border-radius: 2px;
            font-size: 12.5pt;
            color: white;
            width : 100%;
            margin: 0 auto;
            position:absolute;
        }
    </style>
</head>

<body>
    <header>
    <nav>
        <ul id = "menu">
            <li><a href="NovoProduto.php">Voltar</a></li>
        </ul>
   </nav>
        <div id = "user">
        <a name = "sair" class = "sair" href="php/logout.php"><img src="icons/msd.png" alt="Terminar Sessao" title = "Terminar Sessao e Sair"></a>

            <p>
                <?php
                    echo $_SESSION['perfil'];
                ?>
            </p>
        </div>
    </header>

<section class = "container-update">
    <?php
        if(isset($_SESSION['actualizar'])){
            echo $_SESSION['actualizar'];
            unset ($_SESSION['actualizar']);
        }

        if(isset($_SESSION['apagar'])){
            echo $_SESSION['apagar'];
            unset($_SESSION['apagar']);
        }
    ?>
<h2 class = "tt">Gerenciar Produtos</h2>

    <div class = "tabela">
        <table class = "tabela_produtos">
            <th>Produto</th><th>Descricao</th><th>Preco Actual</th><th>Editar</th><th>Apagar</th>
       
                <?php foreach (($sql) as $row) {?>
                    <tr>
                        <td><?php echo $row['Produto'] ?></td>
                        <td><?php echo $row['Descricao']?></td>
                        <td><?php echo $row['Preco'] ?></td>
                        <td><button id = "<?php echo $row['Codigo']?>" class = "edit btn-edit" onclick = "mostrar()"><img src="icons/edit.png" alt=""></button></td>
                        <td><a  class = "apagar" href="php/Main.php?cod='<?php echo $row['Codigo']?>'"><img src="icons/botao-apagar.png" alt=""></a></td>
                    </tr>         
                <?php } ?>
        </table>
    </div>
</section>

    <div class="popup" id="popup">
            <div class="popup-content">
                <span class="fecha" onclick="fechar()">&times;</span>
                <h2>Detalhes</h2>
                <form action="php/Main.php" class = "needs-validation" method="POST" novalidate>
                    <div class = "info_produto" id = "detalhes">
                        
                    </div>
                    <input type="number" name="novopreco" class="form-control novopreco" placeholder="Novo Preco" autocomplete = "off" required>
                    <button  name = "actualizar" class="btn actualizar">Actualizar</button>
                </form>
            </div>
        </div>

    <script src = "js/funcoes.js"></script>
    <script src = "js/form-validation.js"></script>
    <script src = "jquery/jquery.min.js"></script>
    <script>
       $(document).ready(function(){
				$(document).on('click','.btn-edit', function(){
					var cod_produto = $(this).attr("id");
					//Verificar se há valor na variável "cod_produto".
					if(cod_produto !== ''){
						var dados = {
							cod_produto: cod_produto
						};
						$.post('php/detalhes_produto.php', dados, function(retorna){
							//Carregar os detalhes para a modal
							$("#detalhes").html(retorna);
						});
					}
				});
			});
    </script>
</body>
</html>