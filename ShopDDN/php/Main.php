<?php session_start();
require_once("Conexao.php");
include("funcoes/Variaveis.php");

$var = new Variaveis();
$var->setConexao($conexao);

    if(isset($_POST['cadastrar'])){
        //ADICIONAR NOVO USUARIO
        $senha = addslashes($_POST['password']);
        $password = password_hash($senha, PASSWORD_BCRYPT);
        $var->setSexo(addslashes($_POST['sexo']));
        $var->setNome(addslashes($_POST['nome']));
        $var->setEmail(addslashes($_POST['email']));
        $var->setPassword($password);
        
        $var->adicionarUser();
    }


    if(isset($_POST['confirmar'])){
        //LOGIN DO USUARIO
        $var->setEmail(addslashes($_POST['email']));
        $var->setPassword(addslashes($_POST['senha']));

        $var->entrarUser();
    }

    if(isset($_POST['entrar'])){
        //LOGIN DO ADMIN
        $var->setUser(addslashes($_POST['user']));
        $var->setPassword(addslashes($_POST['senha']));

        $var->entrarAdmin();
    }

    if(isset($_POST['adicionar'])){
        //ADICIONAR PRODUTO
        $code = date('mdYhis') . rand(1, 1000);
        $var->setCodigo($code);
        $var->setCategoria(addslashes($_POST['categoria']));
        $var->setProduto(addslashes($_POST['produto']));
        $var->setDescricao(addslashes($_POST['descricao']));
        $var->setPreco(addslashes($_POST['preco']));
        $var->setImagem(addslashes($_FILES['imagem']['name']));
        $var->setValidade(addslashes($_POST['validade']));
        $var->setId_pk($_SESSION['admin_id']);

        
        $var->adicionarProduto();
    }

    if(isset($_POST['confirmar_compra'])){
        //COMPRAR PRODUTO
        $var->setCategoria(addslashes($_POST['ctg']));
        $var->setNome(addslashes($_POST['nome']));
        $var->setQuantidade(addslashes($_POST['quantidade']));
        $var->setContacto(addslashes(($_POST['contacto'])));
        $var->setPagamento(addslashes($_POST['pagamento']));
        $var->setEmail(addslashes($_POST['email']));
        $var->setEndereco(addslashes($_POST['endereco']));
        $var->setConta(addslashes($_POST['nrconta']));
        $var->setId_pk($_POST['codigo']);

        $var->comprar();

    }

    if(isset($_POST['procurar'])){
        //REGISTO DE COMPRAS
        $var->setDatacompra(addslashes($_POST['data']));

        $var->registoCompras();
    }

    if(isset($_POST['procura'])){
        // REGISTO DE COMPRAS DO CARRINHO
        $var->setDatacompra(addslashes($_POST['data-carrinho']));

        $var->registoCarrinho();
    }

    if(isset($_POST['actualizar'])){
        //ACTUALIZAR PRODUTO
        $var->setNovopreco(addslashes($_POST['novopreco']));
        $var->setCodigo(addslashes($_POST['cod_produto']));
        $var->setId_pk($_SESSION['admin_id']);

        $var->actualizarProduto();
    }

    if(isset($_GET['cod'])){
        //APAGAR PRODUTO
        $var->setCodigo($_GET['cod']);
        $var->setId_pk($_SESSION['admin_id']);

        $var->apagarProduto();
    }

    if(isset($_POST['add-novoadmin'])){
        // ADICIONAR NOVO ADMIN
        $senha = addslashes($_POST['password']);
        $password = password_hash($senha, PASSWORD_BCRYPT);
        $var->setUser(addslashes($_POST['user']));
        $var->setImagem(addslashes($_FILES['imagem']['name']));
        $var->setPassword($password);
        $var->setId_pk($_SESSION['admin_id']);

        $var->adicionarAdmin();
    }

?>