<?php
session_start();
    require_once("php/Conexao.php");
    require_once("php/funcoes/functions.php");

    // SQL QUE TRAZ TODOS PRODUTOS DA TABELA [Produtos]
    $sql = pegarProdutos($conexao);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/form-validation.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Produtos</title>
</head>

<body>

    <header>
        <div class="collapse" id="navbarHeader">
        <div class="linha">
                    <div class="info">
                        <div class="slogan">
                            <h4>Sobre</h4>
                            <span class="text-slogan">Melhor Loja Online<br>criada no ano de 2021</span>
                        </div>
                        <div class="contactos">
                            <h4>Contactos</h4>
                            <ul>
                                <li><a href="">WhatsApp</a></li>
                                <li><a href="">Facebook</a></li>
                                <li><a href="">Twitter</a></li>
                            </ul>
                        </div>
                    </div>
                    <form action="Search.php" method="POST">
                        <input type="search" name="search" id="" class="search" autocomplete="off" placeholder="Search"
                            required>
                    </form>
                </div>
        </div>
        <?php
        // NOTIFICACAO DE ERRO
            if(isset($_SESSION['contacto'])){
                echo $_SESSION['contacto'];
                unset ($_SESSION['contacto']);
            }
        ?>
    </header>

        <div class="barra_nav">
            <a href="" class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-cart4"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                </svg>
                <strong>SHOPDDN</strong>
            </a>

            <div>
        
            <label class="usuario">
                <?php 
                    if(isset($_SESSION['usuario'])){ ?>
                    <!-- USUARIO -->
                        <a href = 'php/log_out.php' title = "Terminar Sessao"><?php echo $_SESSION['usuario'];?></a>
                <?php
                    } else{
                        echo "<a href = 'Usuario_Log.php'>Entrar</a>";
                    }
                ?>
            </label>
           
            <button id="barrinhas" onclick="aparecer()">
                &#9776;
            </button>
            </div>
        </div>

            <button onclick="lateral()" id="botao-lateral">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </button>

        <div id="lateral">
            <ul id="listas">
                    <a href="index.php">
                        <li>Home</li>
                    </a>
                
                    <a href="Produtos.php">
                        <li>Produtos</li>
                    </a>
                
                    <li  class = "categoria">
                        Categorias
                            <ul class="drop">
                                <a class="frutas" href="Frutas.php">
                                    <li>Frutas</li>
                                </a>
                                <a class="bebidas" href="Bebidas.php">
                                    <li>Bebidas</li>
                                </a>
                                <a class = "carnes" href="Carnes.php">
                                    <li>Carnes</li>
                                </a>
                            </ul>
                    </li>

                    <a href="Usuario_Log.php">
                        <li>Entrar</li>
                    </a>

                    <a href="Sobre.php">
                        <li>Sobre</li>
                    </a>
            </ul>
        </div>

    <main id="principal">
        <span id = "t"></span>
<section class="categorias" id="categorias">
            <!-- SECTION CATEGORIAS -->
    <h1 class="heading"> Nossas <span>Categorias</span> </h1>

    <div class="box-container">
        <div class="box">
            <img src="imgs/cat-fruits.webp" alt="">
            <h3>Frutas</h3>
            <p>Frescas e de qualidade!</p>
            <a href="Frutas.php" class="visitar">Visitar</a>
        </div>

        <div class="box">
            <img src="imgs/cat-bebidas.webp" alt="">
            <h3>Bebidas</h3>
            <p>Vinhos e Whiskeys!</p>
            <a href="Bebidas.php" class="visitar">Visitar</a>
        </div>

        <div class="box">
            <img src="imgs/cat-carnes.png" alt="">
            <h3>Carnes</h3>
            <p>Maoria das variedades!</p>
            <a href="Carnes.php" class="visitar">Visitar</a>
        </div>

    </div>

</section>

<h1 class="heading"> Nossos <span id = "products">Produtos</span> </h1>
        <div id="cards">
           <?php foreach($sql as $produtos) :?>
            <?php
                verificarProdutos($conexao, $produtos['Validade'], $produtos['Codigo']);
                // VERIFICAR VALIDADE DOS produtos DE TABELA[Produtos]
            ?>
                    <div id = 'card'>
                        <div id = "div-imagem">
                            <img id = 'card-imagem' src='img/<?php echo $produtos['Imagem']?>' alt="">
                        </div>
                    <p id = 'card-text'>
                        Produto : <?php echo $produtos['Produto']?><br>
                        Descricao : <?php echo $produtos['Descricao']?><br>
                        Preco : <?php echo $produtos['Preco']?>MT<br>
                    </p> 
                        <small id = 'val'>
                            Validade : <?php echo $produtos['Validade']?>
                        </small>
                    <div id = 'div-btn-comprar'>
                        <button onclick = 'mostrar()' class = "btn-comprar view_data" id = <?php echo $produtos['ID']?>>Comprar</button>
                    </div>
                        <a id = "add-carrinho" href='Carrinho.php?acao=add&codigo=<?php echo $produtos["Codigo"]?>'><svg height="28" viewBox="0 0 30 30" width="30" xmlns="http://www.w3.org/2000/svg"><path d="M25.5 3C23.02 3 21 5.02 21 7.5s2.02 4.5 4.5 4.5S30 9.98 30 7.5 27.98 3 25.5 3zm0 1C27.44 4 29 5.56 29 7.5S27.44 11 25.5 11 22 9.44 22 7.5 23.56 4 25.5 4zm0 1c-.277 0-.5.223-.5.5V7h-1.5c-.277 0-.5.223-.5.5s.223.5.5.5H25v1.5c0 .277.223.5.5.5s.5-.223.5-.5V8h1.5c.277 0 .5-.223.5-.5s-.223-.5-.5-.5H26V5.5c0-.277-.223-.5-.5-.5zm-15 11h13c.277 0 .5.223.5.5s-.223.5-.5.5h-13c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm-1-4h12c.277 0 .5.223.5.5s-.223.5-.5.5h-12c-.277 0-.5-.223-.5-.5s.223-.5.5-.5zm12 10c-1.375 0-2.5 1.125-2.5 2.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zm-10-1C10.125 22 9 23.125 9 24.5s1.125 2.5 2.5 2.5 2.5-1.125 2.5-2.5-1.125-2.5-2.5-2.5zm0 1c.834 0 1.5.666 1.5 1.5s-.666 1.5-1.5 1.5-1.5-.666-1.5-1.5.666-1.5 1.5-1.5zM.508 4c-.67 0-.677 1 0 1H4.1c.074.355.64 3.055 1.314 6.23.358 1.686.724 3.406 1.018 4.766.293 1.36.505 2.327.588 2.633.132.494.256 1.055.62 1.544.362.488 1 .826 1.86.826h13.992c.86 0 1.498-.338 1.862-.826.363-.49.486-1.05.62-1.545.087-.332.224-1.103.41-2.07.183-.97.4-2.093.6-2.947.165-.613-.856-.88-.972-.226-.206.884-.427 2.012-.612 2.984-.185.973-.347 1.832-.392 2-.136.506-.263.945-.457 1.206-.194.262-.42.424-1.058.424H9.5c-.638 0-.864-.162-1.06-.424-.193-.26-.32-.7-.456-1.205-.05-.193-.28-1.227-.574-2.585-.293-1.358-.66-3.076-1.017-4.764-.716-3.373-1.4-6.624-1.4-6.624-.048-.23-.252-.396-.49-.396zm7.994 4c-.665 0-.657 1 0 1h9.992c.672 0 .657-1 0-1z"/></svg></a>
                    </div>
           <?php endforeach;?>
        </div>

        <div class="popup" id="popup">
            <div class="popup-content">
                <span class="fecha" onclick="fechar()">&times;</span>
                <form action = "php/Main.php" method="POST" class="needs-validation" novalidate>
                    <!-- FORMULARIO DE PAGAMENTO -->
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
                    <input type="hidden" name = "ctg" value = "Produtos">
                    <!-- INPUT HIDDEN QUE RECEBE A COGIGO[Chave Primaria] -->
                    <input type="hidden" id = "codigo" name = "codigo">

                    <label for="quantidade">Quantidade</label><br>
                    <input type="number" class="form-control" name="quantidade" id="quantidade"  min="1" maxlength="3" required>         
                    
                    </br>
                    <label for="nome">Nome</label><br>
                    <input type="text" autocomplete="off" class="form-control" name="nome" id="nome" maxlength="60" required>
           
                    <br>
                    <label for="contacto">Contacto</label><br>
                    <input type="number" class="form-control" name="contacto" id="contacto" maxlength="9"
                        required>

                    <br>
                    <label for="conta">Numero da Conta</label><br>
                    <input type="number" class="fr" name="nrconta" id="conta" maxlength="16">

                    <br>
                    <label for="email">Email</label><br>
                    <input type="email" autocomplete="off" class="form-control" name="email" id="email" maxlength="40" required>

                    <br>
                    <label for="endereco">Endereco</label><br>
                    <input type="text" autocomplete="off" class="form-control" name="endereco" id="endereco" maxlength="20" required>

                    <br>
                    <button name = "confirmar_compra" id="confirmar_compra">Confirmar</button>
                </form>
            </div>
        </div>
    </main>

<section class="footer">
    <!-- SECTION DE RODAPE -->
    <div class="foot-container">
        <div class="foot">
            <h3><i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-cart4"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" />
                </svg></i>SHOPDDN</h3>
            <p class = "slog">Site de venda de produtos alimentares</p>
            <div class="share">
                <a href="#" class ="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
        </div>

        <div class="foot">
            <h3>Contactos</h3>
            <a href="#" class="links"> <i class="fas fa-phone"></i>(+258) 846387041</a>
            <a href="#" class="links"> <i class="fas fa-phone"></i> (+258) 872876066 </a>
            <a href="#" class="links"> <i class="fas fa-envelope"></i> jnhanombe59@gmail.com </a>
            <a href="#" class="links"> <i class="fas fa-map-marker-alt"></i>Maputo, Tsalala, Q. 111 </a>
        </div>

        <div class="foot">
            <h3>Links</h3>
            <a href="index.php" class="links"> <i class="fas fa-arrow-right"></i> Home</a>
            <a href="#products" class="links"> <i class="fas fa-arrow-right"></i> Produtos </a>
            <a href="#" class="links" id = "ct"> <i class="fas fa-arrow-right"></i> Categorias </a>
            <a href="Usuario_Log.php" class="links"> <i class="fas fa-arrow-right"></i> Login </a>
            <a href="Sobre.php" class="links"> <i class="fas fa-arrow-right"></i> Sobre </a>
        </div>

    <div class="foot reclamacao">
            <h3>Caixa de Reclamacoes</h3>
        <form action="https://formsubmit.co/9ae7d72953c1e3c663a867e4b34a19e9" method="POST" class="needs-validation" novalidate>
            <!-- FORMULARIO DE RECLAMACOES -->
            <input type="email" class="form-control" name = "Email" placeholder="Email" required autocomplete="off">
            <input type="text" class = "form-control" name  = "Nome" placeholder="Nome" required autocomplete="off">
            <textarea name="Mensagem" class = "msg form-control" cols="30" rows="10" placeholder="Mensagem" required></textarea>
            <input type="hidden" name="_next" value="http://localhost/Produtos.php">
            <button type = "submit" class="btn">Enviar</button>
        </form>
     </div>
    </div>
    <footer id = "rodape">
    <p class = "developer">Copyright &copy; <br>by Dario Domingos - 2021</p>
    </footer>
</section>
</body>
    <script src="js/funcoes.js"></script>
    <script src="js/form-validation.js"></script>
    <script src = "jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
    // PASSAR A CATEGORIA PARA A MODAL
            $(document).on('click', '.view_data', function(){
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
