<?php session_start();
    require_once("php/Conexao.php");
    // PALAVRA CHAVE DE PESQUISA
    $search = addslashes($_POST['search']);

    // TABELA PRODUTOS
    $sqlPr = $conexao->query("SELECT * FROM Produtos WHERE Produto LIKE '%$search%' OR Descricao LIKE '%$search%'");
    // TABELA BEBIDAS
    $sqlBe = $conexao->query("SELECT *  FROM Bebidas WHERE Produto LIKE '%$search%' OR Descricao LIKE '%$search%'");
    // TABELA CARNES
    $sqlCa = $conexao->query("SELECT * FROM Carnes WHERE Produto LIKE '%$search%' OR Descricao LIKE '%$search%'");
    // TABELA FRUTAS
    $sqlFr = $conexao->query("SELECT * FROM Frutas WHERE Produto LIKE '%$search%' OR Descricao LIKE '%$search%'");

?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form-validation.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Resultados</title>

    <style>
    .sch{
        text-indent:20px;
        font-size: 11pt !important;
    }

    #menu{
        display: flex;
        flex-wrap:wrap ;
        margin: 3.1rem;
    }

    #menu li{
        list-style: none;
    }
    #menu li a{
        border: 0.7px solid rgb(7, 62, 114);
        border-radius: 0.25rem;
        color: rgb(255,255,255);
        background-color: rgb(0,0,0);
        padding: .9rem;
        font-size: 1.5rem;
    }

    #menu a:hover{
        color: #000;
        background-color: rgb(255,255,255);
        transition: 0.2s;
    }
    @media screen and (max-device-width: 957px) {
    
        #menu li a{
            padding: .9rem;
            font-size: 1.2rem;
        }

        #menu{
            margin: 1.2rem;
        }
        
        #menu li{
            margin-top: 1rem;
        }
    }
    </style>
</head>

<body>
    <h4>Resultados</h4>
      <p class = "sch">Cerca de <?php foreach($conexao->query("SELECT count(*) FROM (SELECT * FROM Bebidas UNION ALL SELECT * FROM Produtos UNION ALL SELECT * FROM Frutas UNION ALL SELECT * FROM Carnes) RES WHERE Produto LIKE '%$search%' OR Descricao LIKE '%$search%'") as $nSearchs){
          echo $nSearchs[0];
        //TOTAL DE PRODUTOS ENCONTRADOS DURANTE A PESQUISA
      }
      ?> resultados para <strong><?php echo $search;?></strong></p>

        <ul id = "menu">
            <li><a href="Produtos.php">Voltar</a></li>
        </ul>

    <div id="cards">
           <?php foreach($sqlPr as $produtos) :?>
            <!-- PRODUTOS DA TABELA [Produtos] -->
                    <div id = 'card'>
                        <div id = "div-imagem">
                            <img id = 'card-imagem' src='img/<?php echo $produtos['Imagem']?>' alt="">
                        </div>
                    <p id = 'card-text'>
                        Produto : <?php echo $produtos['Produto']?><br>
                        Descricao : <?php echo $produtos['Descricao']?><br>
                        Preco : <?php echo $produtos['Preco']?>MT<br>
                    </p> 
            <input type="hidden" id="categoria" value  = "Produtos">
                        <small id = 'val'>
                            Validade : <?php echo $produtos['Validade']?>
                        </small>
                    <div id = 'div-btn-comprar'>
                        <button onclick = "mostrar()" class = "btn-comprar view_data" id = <?php echo $produtos["Produtos_ID"]?>>Comprar</button>
                    </div>
                        <a id = "add-carrinho" href='Carrinho.php?acao=add&codigo=<?php echo $produtos["Codigo"]?>'><svg height="28" viewBox="0 0 30 30" width="30" xmlns="http://www.w3.org/2000/svg"><path d="M25.5 3C23.02 3 21 5.02 21 7.5s2.02 4.5 4.5 4.5S30 9.98 30 7.5 27.98 3 25.5 3zm0 1C27.44 4 29 5.56 29 7.5S27.44 11 25.5 11 22 9.44 22 7.5 23.56 4 25.5 4zm0 1c-.277 0-.5.223-.5.5V7h-1.5c-.277 0-.5.223-.5.5s.223.5.5.5H25v1.5c0 .277.223.5.5.5s.5-.223.5-.5V8h1.5c.277 0 .5-.223.5-.5s-.223-.5-.5-.5H26V5.5c0-.277-.223-.5-.5-.5zm-15 11h13c.277 0 .5.223.5.5s-.223.5-.5.5h-13c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm-1-4h12c.277 0 .5.223.5.5s-.223.5-.5.5h-12c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm12 10c-1.375 0-2.5 1.125-2.5 2.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zm-10-1C10.125 22 9 23.125 9 24.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zM.508 4c-.67 0-.677 1 0 1H4.1c.074.355.64 3.055 1.314 6.23.358 1.686.724 3.406 1.018 4.766.293 1.36.505 2.327.588 2.633.132.494.256 1.055.62 1.544.362.488 1 .826 1.86.826h13.992c.86 0 1.498-.338 1.862-.826.363-.49.486-1.05.62-1.545.087-.332.224-1.103.41-2.07.183-.97.4-2.093.6-2.947.165-.613-.856-.88-.972-.226-.206.884-.427 2.012-.612 2.984-.185.973-.347 1.832-.392 2-.136.506-.263.945-.457 1.206-.194.262-.42.424-1.058.424H9.5c-.638 0-.864-.162-1.06-.424-.193-.26-.32-.7-.456-1.205-.05-.193-.28-1.227-.574-2.585-.293-1.358-.66-3.076-1.017-4.764-.716-3.373-1.4-6.624-1.4-6.624-.048-.23-.252-.396-.49-.396zm7.994 4c-.665 0-.657 1 0 1h9.992c.672 0 .657-1 0-1z"/></svg></a>
                    </div>
           <?php endforeach;?>

           <?php foreach($sqlBe as $bebidas) :?>
            <!-- PRODUTOS DA TABELA BEBIDAS -->
                    <div id = 'card'>
                        <div id = "div-imagem">
                            <img id = 'card-imagem' src='img/<?php echo $bebidas['Imagem']?>' alt="">
                        </div>
                    <p id = 'card-text'>
                        Produto : <?php echo $bebidas['Produto']?><br>
                        Descricao : <?php echo $bebidas['Descricao']?><br>
                        Preco : <?php echo $bebidas['Preco']?>MT<br>
                    </p> 
            <input type="hidden" id="categoria" value  = "Bebidas">
        
                        <small id = 'val'>
                            Validade : <?php echo $bebidas['Validade']?>
                        </small>
                    <div id = 'div-btn-comprar'>
                        <button onclick = "mostrar()" class = "btn-comprar view_data" id = <?php echo $bebidas["Bebidas_ID"]?>>Comprar</button>
                    </div>
                        <a id = "add-carrinho" href='Carrinho.php?acao=add&codigo=<?php echo $bebidas["Codigo"]?>'><svg height="28" viewBox="0 0 30 30" width="30" xmlns="http://www.w3.org/2000/svg"><path d="M25.5 3C23.02 3 21 5.02 21 7.5s2.02 4.5 4.5 4.5S30 9.98 30 7.5 27.98 3 25.5 3zm0 1C27.44 4 29 5.56 29 7.5S27.44 11 25.5 11 22 9.44 22 7.5 23.56 4 25.5 4zm0 1c-.277 0-.5.223-.5.5V7h-1.5c-.277 0-.5.223-.5.5s.223.5.5.5H25v1.5c0 .277.223.5.5.5s.5-.223.5-.5V8h1.5c.277 0 .5-.223.5-.5s-.223-.5-.5-.5H26V5.5c0-.277-.223-.5-.5-.5zm-15 11h13c.277 0 .5.223.5.5s-.223.5-.5.5h-13c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm-1-4h12c.277 0 .5.223.5.5s-.223.5-.5.5h-12c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm12 10c-1.375 0-2.5 1.125-2.5 2.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zm-10-1C10.125 22 9 23.125 9 24.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zM.508 4c-.67 0-.677 1 0 1H4.1c.074.355.64 3.055 1.314 6.23.358 1.686.724 3.406 1.018 4.766.293 1.36.505 2.327.588 2.633.132.494.256 1.055.62 1.544.362.488 1 .826 1.86.826h13.992c.86 0 1.498-.338 1.862-.826.363-.49.486-1.05.62-1.545.087-.332.224-1.103.41-2.07.183-.97.4-2.093.6-2.947.165-.613-.856-.88-.972-.226-.206.884-.427 2.012-.612 2.984-.185.973-.347 1.832-.392 2-.136.506-.263.945-.457 1.206-.194.262-.42.424-1.058.424H9.5c-.638 0-.864-.162-1.06-.424-.193-.26-.32-.7-.456-1.205-.05-.193-.28-1.227-.574-2.585-.293-1.358-.66-3.076-1.017-4.764-.716-3.373-1.4-6.624-1.4-6.624-.048-.23-.252-.396-.49-.396zm7.994 4c-.665 0-.657 1 0 1h9.992c.672 0 .657-1 0-1z"/></svg></a>
                    </div>
           <?php endforeach;?>
           
           <?php foreach($sqlCa as $carnes) :?>
            <!-- PRODUTOS DA TABELA DE CARNES -->
                    <div id = 'card'>
                        <div id = "div-imagem">
                            <img id = 'card-imagem' src='img/<?php echo $carnes['Imagem']?>' alt="">
                        </div>
                    <p id = 'card-text'>
                        Produto : <?php echo $carnes['Produto']?><br>
                        Descricao : <?php echo $carnes['Descricao']?><br>
                        Preco : <?php echo $carnes['Preco']?>MT<br>
                    </p> 
            <input type="hidden" id="categoria" value  = "Carnes">
        
                        <small id = 'val'>
                            Validade : <?php echo $carnes['Validade']?>
                        </small>
                    <div id = 'div-btn-comprar'>
                        <button onclick = "mostrar()" class = "btn-comprar view_data" id = <?php echo $carnes["Carnes_ID"]?>>Comprar</button>
                    </div>
                        <a id = "add-carrinho" href='Carrinho.php?acao=add&codigo=<?php echo $carnes["Codigo"]?>'><svg height="28" viewBox="0 0 30 30" width="30" xmlns="http://www.w3.org/2000/svg"><path d="M25.5 3C23.02 3 21 5.02 21 7.5s2.02 4.5 4.5 4.5S30 9.98 30 7.5 27.98 3 25.5 3zm0 1C27.44 4 29 5.56 29 7.5S27.44 11 25.5 11 22 9.44 22 7.5 23.56 4 25.5 4zm0 1c-.277 0-.5.223-.5.5V7h-1.5c-.277 0-.5.223-.5.5s.223.5.5.5H25v1.5c0 .277.223.5.5.5s.5-.223.5-.5V8h1.5c.277 0 .5-.223.5-.5s-.223-.5-.5-.5H26V5.5c0-.277-.223-.5-.5-.5zm-15 11h13c.277 0 .5.223.5.5s-.223.5-.5.5h-13c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm-1-4h12c.277 0 .5.223.5.5s-.223.5-.5.5h-12c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm12 10c-1.375 0-2.5 1.125-2.5 2.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zm-10-1C10.125 22 9 23.125 9 24.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zM.508 4c-.67 0-.677 1 0 1H4.1c.074.355.64 3.055 1.314 6.23.358 1.686.724 3.406 1.018 4.766.293 1.36.505 2.327.588 2.633.132.494.256 1.055.62 1.544.362.488 1 .826 1.86.826h13.992c.86 0 1.498-.338 1.862-.826.363-.49.486-1.05.62-1.545.087-.332.224-1.103.41-2.07.183-.97.4-2.093.6-2.947.165-.613-.856-.88-.972-.226-.206.884-.427 2.012-.612 2.984-.185.973-.347 1.832-.392 2-.136.506-.263.945-.457 1.206-.194.262-.42.424-1.058.424H9.5c-.638 0-.864-.162-1.06-.424-.193-.26-.32-.7-.456-1.205-.05-.193-.28-1.227-.574-2.585-.293-1.358-.66-3.076-1.017-4.764-.716-3.373-1.4-6.624-1.4-6.624-.048-.23-.252-.396-.49-.396zm7.994 4c-.665 0-.657 1 0 1h9.992c.672 0 .657-1 0-1z"/></svg></a>
                    </div>
           <?php endforeach;?>

           <?php foreach($sqlFr as $frutas) :?>
            <!-- PRODUTOS DA TABELA DE FRUTAS -->
                    <div id = 'card'>
                        <div id = "div-imagem">
                            <img id = 'card-imagem' src='img/<?php echo $frutas['Imagem']?>' alt="">
                        </div>
                    <p id = 'card-text'>
                        Produto : <?php echo $frutas['Produto']?><br>
                        Descricao : <?php echo $frutas['Descricao']?><br>
                        Preco : <?php echo $frutas['Preco']?>MT<br>
                    </p> 
            <input type="hidden" id="categoria" value  = "Frutas">
        
                        <small id = 'val'>
                            Validade : <?php echo $frutas['Validade']?>
                        </small>
                    <div id = 'div-btn-comprar'>
                        <button onclick = "mostrar()" class = "btn-comprar view_data" id = <?php echo $frutas["Frutas_ID"]?>>Comprar</button>
                    </div>
                        <a id = "add-carrinho" href='Carrinho.php?acao=add&codigo=<?php echo $frutas["Codigo"]?>'><svg height="28" viewBox="0 0 30 30" width="30" xmlns="http://www.w3.org/2000/svg"><path d="M25.5 3C23.02 3 21 5.02 21 7.5s2.02 4.5 4.5 4.5S30 9.98 30 7.5 27.98 3 25.5 3zm0 1C27.44 4 29 5.56 29 7.5S27.44 11 25.5 11 22 9.44 22 7.5 23.56 4 25.5 4zm0 1c-.277 0-.5.223-.5.5V7h-1.5c-.277 0-.5.223-.5.5s.223.5.5.5H25v1.5c0 .277.223.5.5.5s.5-.223.5-.5V8h1.5c.277 0 .5-.223.5-.5s-.223-.5-.5-.5H26V5.5c0-.277-.223-.5-.5-.5zm-15 11h13c.277 0 .5.223.5.5s-.223.5-.5.5h-13c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm-1-4h12c.277 0 .5.223.5.5s-.223.5-.5.5h-12c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm12 10c-1.375 0-2.5 1.125-2.5 2.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zm-10-1C10.125 22 9 23.125 9 24.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zM.508 4c-.67 0-.677 1 0 1H4.1c.074.355.64 3.055 1.314 6.23.358 1.686.724 3.406 1.018 4.766.293 1.36.505 2.327.588 2.633.132.494.256 1.055.62 1.544.362.488 1 .826 1.86.826h13.992c.86 0 1.498-.338 1.862-.826.363-.49.486-1.05.62-1.545.087-.332.224-1.103.41-2.07.183-.97.4-2.093.6-2.947.165-.613-.856-.88-.972-.226-.206.884-.427 2.012-.612 2.984-.185.973-.347 1.832-.392 2-.136.506-.263.945-.457 1.206-.194.262-.42.424-1.058.424H9.5c-.638 0-.864-.162-1.06-.424-.193-.26-.32-.7-.456-1.205-.05-.193-.28-1.227-.574-2.585-.293-1.358-.66-3.076-1.017-4.764-.716-3.373-1.4-6.624-1.4-6.624-.048-.23-.252-.396-.49-.396zm7.994 4c-.665 0-.657 1 0 1h9.992c.672 0 .657-1 0-1z"/></svg></a>
                    </div>
           <?php endforeach;?>
           </div>

           <div class="popup" id="popup">
               <!-- FORMULARIO DE PAGAMENTO -->
            <div class="popup-content">
                <span class="fecha" onclick="fechar()">&times;</span>
                <form action = "php/Main.php" method="POST" class="needs-validation" novalidate>
                    
                <label id="lbl" for="pagamento">Pagamento</label><br>
                    <select name="pagamento" id="pagamento" class = "form-control" required>
                    <option value = "" disabled selected>Metodo</option>
                        <option value="Millenium Bim">Millenium Bim</option>
                        <option value="BCI">BCI</option>
                        <option value="Absa">Absa</option>
                        <option value="M-Pesa">M-Pesa</option>
                        <option value="E-Mola">E-Mola</option>
                        <option value="Conta Movel">Conta Movel</option>
                    </select>

                    <!-- INPUT HIDDEN QUE RECEBE A CATEGORIA -->
                    <input type="hidden" name = "ctg" id = "ctg">
                    <!-- INPUT HIDDEN QUE RECEBE A COGIGO[Chave Primaria] -->
                    <input type="hidden" id = "codigo" name = "codigo">

                    <label for="quantidade">Quantidade</label><br>
                    <input type="number" class="form-control" name="quantidade" id="quantidade"  min="1" maxlength="3" required>         
                    
                    <?php if(isset($_SESSION['usuario'])) {
                        $nome = $_SESSION['usuario'] ; ?>

                    </br>
                        <label for="nome">Nome</label><br>
                        <input type="text" autocomplete="off" class="form-control" name="nome" id="nome" value = "<?php echo $nome?>" maxlength="60" required>

                    <?php } else {?>

                        </br>
                        <label for="nome">Nome</label><br>
                        <input type="text" autocomplete="off" class="form-control" name="nome" id="nome" maxlength="60" required>

                    <?php } ?>
           
                    <br>
                    <label for="contacto">Contacto</label><br>
                    <input type="number" class="form-control" name="contacto" id="contacto" maxlength="9"
                        required>

                    <br>
                    <label for="conta">Numero da Conta</label><br>
                    <input type="number" class="fr" name="nrconta" id="conta" maxlength="16">

                    <?php if(isset($_SESSION['usuario'])) {
                        $email = $_SESSION['email'] ; ?>

                    </br>
                    <label for="email">Email</label><br>
                    <input type="email" autocomplete="off" class="form-control" name="email" id="email" value = "<?php echo $email?>" maxlength="40" required>

                    <?php } else {?>
                        
                    </br>
                    <label for="email">Email</label><br>
                    <input type="email" autocomplete="off" class="form-control" name="email" id="email" maxlength="40" required>

                    <?php } ?>

                    <br>
                    <label for="endereco">Endereco</label><br>
                    <input type="text" autocomplete="off" class="form-control" name="endereco" id="endereco" maxlength="20" required>

                    <br>
                    <button name = "confirmar_compra" id="confirmar_compra">Confirmar</button>
                </form>
            </div>
        </div>
</body>

<script src="js/funcoes.js"></script>
<script src="js/form-validation.js"></script>
<script src = "jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.view_data', function(){
    // PASSAR A CATEGORIA PARA A MODAL
            var txt =document.getElementById("categoria");
            var ctg =document.getElementById("ctg");
            var cat = txt.value
            ctg.value = cat
    // PASSAR A CHAVE PRIMARIA PARA A MODAL
                var cod = $(this).attr("id");
                var codigo = document.getElementById("codigo");
                codigo.value = cod
            });
        });

        $("#pagamento").change(function() {
    // PASSAR O REQUIRED PARA O INPUT[NUMERO DA CONTA] CASO SEJA SELECIONADO O METODO QUE EXIJA O NUMERO DA CONTA
        if (this.value == "Millenium Bim" || this.value == "BCI" || this.value == "Absa") {
            $('#conta').attr('required','required');
        } else{
            $("#conta").removeAttr('required', '')
        }
        });
      
    </script>
</html>