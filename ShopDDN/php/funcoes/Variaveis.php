<?php
class Variaveis{
        //VARIAVEIS
        private $nome;
        private $email;
        private $sexo;
        private $password;
        private $newname;
        private $user;
        private $categoria;
        private $contacto;
        private $produto;
        private $descricao;
        private $preco;
        private $imagem;
        private $codigo;
        private $conexao;
        private $validade;
        private $resfinal;
        private $quantidade;
        private $pagamento;
        private $endereco;
        private $conta;
        private $novopreco;
        private $pesquisa;
        private $datacompra;
        private $id_pk;
        
    // GETTERS AND SETTERS
        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getSexo(){
            return $this->sexo;
        }

        public function setSexo($sexo){
            $this->sexo = $sexo;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function getNewname(){
            return $this->newname;
        }

        public function setNewname($newname){
            $this->newname = $newname;
        }

        public function getUser(){
            return $this->user;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function getAdmin(){
            return $this->admin;
        }

        public function setAdmin($admin){
            $this->admin = $admin;
        }

        public function getCategoria(){
            return $this->categoria;
        }

        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        public function getProduto(){
            return $this->produto;
        }

        public function setProduto($produto){
            $this->produto = $produto;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }

        public function getPreco(){
            return $this->preco;
        }

        public function setPreco($preco){
            $this->preco = $preco;
        }

        public function getImagem(){
            return $this->imagem;
        }

        public function setImagem($imagem){
            $this->imagem = $imagem;
        }

        public function getConexao(){
            return $this->conexao;
        }

        public function setConexao($conexao){
            $this->conexao = $conexao;
        }

        public function getValidade(){
            return $this->validade;
        }

        public function setValidade($validade){
            $this->validade = $validade;
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function getResfinal(){
            return $this->resfinal;
        }

        public function setResfinal($resfinal){
            $this->resfinal = $resfinal;
        }

        public function getQuantidade(){
            return $this->quantidade;
        }

        public function setQuantidade($quantidade){
            $this->quantidade = $quantidade;
        }

        public function getContacto(){
            return $this->contacto;
        }

        public function setContacto($contacto){
            $this->contacto = $contacto;
        }

        public function getPagamento(){
            return $this->pagamento;
        }

        public function setPagamento($pagamento){
            $this->pagamento = $pagamento;
        }

        public function getEndereco(){
            return $this->endereco;
        }

        public function setEndereco($endereco){
            $this->endereco = $endereco;
        }

        public function getConta(){
            return $this->conta;
        }

        public function setConta($conta){
            $this->conta = $conta;
        }

        public function getNovopreco(){
            return $this->novopreco;
        }

        public function setNovopreco($novopreco){
            $this->novopreco = $novopreco;
        }

        public function getTotal(){
            return $this->total;
        }

        public function setTotal($total){
            $this->total = $total;
        }

        public function getPesquisa(){
            return $this->pesquisa;
        }

        public function setPesquisa($pesquisa){
            $this->pesquisa = $pesquisa;
        }

        public function getDatacompra(){
            return $this->datacompra;
        }

        public function setDatacompra($datacompra){
            $this->datacompra = $datacompra;
        }

        public function getId_pk(){
            return $this->id_pk;
        }

        public function setId_pk($id_pk){
            $this->id_pk = $id_pk;
        }
 

        function adicionarUser(){
            //ADICIONAR NOVO USUARIO
            try {
                if(!$this->verNome($this->getNome())){
                    $_SESSION['newuser'] = "<p class = 'erro'>Nome Invalido!</p>";
                    header("Location:/NovoUsuario.php");
                } else {
                    $sql = $this->getConexao()->prepare("INSERT INTO Cliente (Nome, Email, Sexo, Password) VALUES (?,?,?,?)");
                    $sql->bindValue(1, $this->getNome());
                    $sql->bindValue(2, $this->getEmail());
                    $sql->bindValue(3, $this->getSexo());
                    $sql->bindValue(4, $this->getPassword());
                    $sql->execute();
                    header("Location:/Usuario_Log.php");
                }
            } catch (Exception $e) {
                $_SESSION['newuser'] = "Erro ao adicionar Usuario";
                header("Location:/NovoUsuario.php");
            } 
        }

        function adicionarAdmin(){
            //ADICIONAR NOVO ADMINISTRADOR
            $formato = array('png', 'jpg', 'jpeg');
                $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        
                if(in_array($extensao, $formato)){
                    $folder = "../admins/";
                    $tmp = $_FILES['imagem']['tmp_name'];
                    $this->setNewname(uniqid().$this->getImagem());
        
                    if(move_uploaded_file($tmp, $folder.$this->getNewname())){
                        try{
                            $sql = $this->getConexao()->prepare("INSERT INTO Administrador (User, Senha, Foto_Perfil) VALUES (?,?,?)");
                            $sql->bindValue(1, $this->getUser());
                            $sql->bindValue(2, $this->getPassword());
                            $sql->bindValue(3, $this->getNewname());
                            $sql->execute();
                            $this->setResfinal("Novo Admininistrador adicionado : ". $this->getUser());
                            $this->guardarHistorico();
                            $_SESSION['addadmin'] = "<p class = 'sucesso'>Administrador Adicionado!</p>";

                        } catch(Exception $e){
                           echo $e->getMessage();
                        }
                    } else{
                        $_SESSION['addadmin'] = "<p class = 'erro'>Erro ao carregar imagem de perfil!</p>";
                    }
                } else{
                    $_SESSION['addadmin'] = "<p class = 'erro'>Extensao da imagem nao permitida!</p>";
                }
                header("Location:/Novo_Admin.php");

        }

        function entrarUser(){
            //LOGIN DO USUARIO
            try {
                $sql = $this->getConexao()->prepare("SELECT * FROM Cliente WHERE Email = ?");
                $sql->bindValue(1, $this->getEmail());
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);

                if($sql->rowCount() AND password_verify($this->getPassword(), $result['Password'])){
                        $_SESSION['usuario'] =  $result['Nome'];
                        $_SESSION['cliente_id'] = $result['Cliente_ID'];
                        header("Location:/Produtos.php");
                    } else{
                        $_SESSION['login'] = "<p class = 'erro'>Email ou Senha Incorrectos!</p>";
                        header("Location:/Usuario_Log.php");
                    }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        function entrarAdmin(){
            //LOGIN DO ADMINISTRADOR
            $sql = $this->getConexao()->prepare("SELECT * FROM Administrador WHERE User = ?");
            $sql->bindValue(1, $this->getUser());
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
        
            if($sql->rowCount() AND password_verify($this->getPassword(), $result['Senha'])){
                $admin = $result['Tipo'];   //TIPO DE ADMINISTRADOR
                $idlogado = $result['User']; //NOME DO ADMINISTRADOR
                $foto_perfil = $result['Foto_Perfil'];  //FOTO DE PERFIL
                $_SESSION['admin_tipo'] = $result['Tipo'];   //TIPO DE ADMINISTRADOR PARA VERIFICAR O TIPO DE ADMINISTRADOR
                $_SESSION['admin_id'] = $result['Admin_ID']; //ID DO ADMIN
        
                $_SESSION['admin'] =  $idlogado;//ENVIA O NOME DO ADMIN PARA SER GUARDADO NO HISTORICO DE USUARIO
                $_SESSION['perfil'] = "</br><img id = 'user-imagem' src = '/admins/$foto_perfil'>". "<p id = 'name-user'>$idlogado</p>";
                
                if($admin){
                    header("Location:/NovoProduto.php");
                } else{
                    header("Location:/RegistoCompras.php");
                }
            } else{
                $_SESSION['login-admin'] = "<p class = 'erro'>User ou Password Incorrectos!</p>";
                header("Location:/Administrador.php");
            }
        }

        function adicionarProduto(){
            //ADICIONAR NOVO PRODUTO
                $formato = array('png', 'jpg', 'jpeg', 'webp');
                $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        
                if(in_array($extensao, $formato)){
                    $folder = "../img/";
                    $tmp = $_FILES['imagem']['tmp_name'];
                    $this->setNewname(uniqid().$this->getImagem());
        
                    if(move_uploaded_file($tmp, $folder.$this->getNewname())){
                        try{
                            $sql = $this->getConexao()->prepare("INSERT INTO " . $this->getCategoria() . "(Codigo, Produto, Descricao, Preco, Imagem, Validade, Admin_FK) VALUES (?,?,?,?,?,?,?)");
                            $sql->bindValue(1, $this->getCodigo());
                            $sql->bindValue(2, $this->getProduto());
                            $sql->bindValue(3, $this->getDescricao());
                            $sql->bindValue(4, $this->getPreco());
                            $sql->bindValue(5, $this->getNewname());
                            $sql->bindValue(6, $this->getValidade());
                            $sql->bindValue(7, $this->getId_pk());
                            $sql->execute();

                            $this->setResfinal("Adicionou produto : {$this->getProduto()}");
                            $this->guardarHistorico();
                            $_SESSION['addproduto'] = "<p class = 'sucesso'>Produto Adicionado Com Sucesso</p>";

                        } catch(Exception $e){
                           echo $e->getMessage();
                        }
                    } else{
                        $_SESSION['addproduto'] = "<p class = 'erro'>Erro ao carregar imagem do produto!</p>";
                    }
                } else{
                    $_SESSION['addproduto'] = "<p class = 'erro'>Extensao da imagem nao permitida!</p>";
                }
                header("Location:../NovoProduto.php");
        }

        function comprar(){
            //COMPRAR PRODUTO   
            if(!$this->verContacto($this->getContacto())){
                $_SESSION['contacto'] = "<p class = 'erro'>Contacto Invalido!</p>";
                header("Location:/{$this->getCategoria()}.php");
            } else if(!$this->verNome($this->getNome())){
                $_SESSION['contacto'] = "<p class = 'erro'>Nome Invalido!</p>";
                header("Location:/{$this->getCategoria()}.php");
            } else {
                        if($this->getPagamento() == "M-Pesa" || $this->getPagamento() == "Conta Movel" || $this->getPagamento() == "E-Mola"){
                            if (!$this->verPagamento($this->getPagamento(), $this->getContacto())) {
                                $_SESSION['contacto'] = "<p class = 'erro'>Contacto invalido para o metodo inserido!</p>";
                                header("Location:/{$this->getCategoria()}.php");
                            } else{
                                $sql = $this->getConexao()->prepare("INSERT INTO Compra (Quantidade, Nome, Contacto, Pagamento, Email, Endereco, {$this->getCategoria()}_FK) VALUES (?,?,?,?,?,?,?)");
                                $sql->bindValue(1, $this->getQuantidade());
                                $sql->bindValue(2, $this->getNome());
                                $sql->bindValue(3, $this->getContacto());
                                $sql->bindValue(4, $this->getPagamento());
                                $sql->bindValue(5, $this->getEmail());
                                $sql->bindValue(6, $this->getEndereco());
                                $sql->bindValue(7, $this->getId_pk());
                                $sql->execute();
                            }
                        } else{
                            if(!$this->verConta($this->getConta())){
                                $_SESSION['contacto'] = "<p class = 'erro'>Numero da Conta Invalido!</p>";
                                header("Location:/{$this->getCategoria()}.php");
                            } else {
                                $sql = $this->getConexao()->prepare("INSERT INTO Compra (Quantidade, Nome, Contacto, Pagamento, NRConta, Email, Endereco, {$this->getCategoria()}_FK) VALUES (?,?,?,?,?,?,?,?)");
                                $sql->bindValue(1, $this->getQuantidade());
                                $sql->bindValue(2, $this->getNome());
                                $sql->bindValue(3, $this->getContacto());
                                $sql->bindValue(4, $this->getPagamento());
                                $sql->bindValue(5, $this->getConta());
                                $sql->bindValue(6, $this->getEmail());
                                $sql->bindValue(7, $this->getEndereco());
                                $sql->bindValue(8, $this->getId_pk());
                                $sql->execute();
                            }
                        }
                
                    foreach($this->getConexao()->query("SELECT Produto, Descricao, Preco, Compra.Nome, Compra.Data FROM {$this->getCategoria()} JOIN Compra WHERE {$this->getCategoria()}_ID = {$this->getId_pk()} AND Compra.Data = NOW()") as $row){
                        $_SESSION['result-data'] = $row['Data'];
                        $preco_total = $row['Preco'] * $this->getQuantidade();
                        $_SESSION['result-compra-nome'] =  $row['Nome'];
                        $_SESSION['result-compra-produto'] =  $row['Produto'];
                        $_SESSION['result-compra-descricao'] =   $row['Descricao'];
                        $_SESSION['result-compra-preco'] = $row['Preco'];
                        $_SESSION['result-compra-qtd'] =   $this->getQuantidade();
                        $_SESSION['result-compra-total'] =   $preco_total;

                    header("Location:/Recibo.php");
                    }
                }
                
            }
        

        function registoCompras(){
            //REGISTRO DE COMPRAS
            foreach($this->getConexao()->query("SELECT Produtos.Produto, Produtos.Descricao, Produtos.Preco, Compra.Nome, Compra.Contacto, Compra.Pagamento, Compra.NRConta, Compra.Email, Compra.Endereco, Compra.Quantidade, Compra.Data,  Compra.Produtos_FK FROM Compra JOIN Produtos WHERE Produtos.Produtos_ID = Compra.Produtos_FK AND Compra.Data LIKE  ('%".$this->getDatacompra()."%')") as $linha){
                $_SESSION['infos'] =  
                        'Cliente: '.$linha['Nome'].'<br>'. 
                        'Contacto (+258) : '.$linha['Contacto'].'<br>'. 
                        'Pagamento :' .$linha['Pagamento'].'<br>'. 
                        'NRConta : ' .$linha['NRConta'].'<br>'.
                        'Email :' .$linha['Email'].'<br>'. 
                        'Endereco :' .$linha['Endereco']. '<br>';
                       
                $_SESSION['produtos'] = 
                        'Produto :' .$linha['Produto']. '<br>'.
                        'Descricao :' .$linha['Descricao']. '<br>'.
                        'Quantidade :' .$linha['Quantidade']. " ".'Units<br>'.
                        'Preco : '.$linha['Preco']. 'MT<br>'.
                        'Data : ' .$this->getDatacompra().'<br>'.
                        '<strong>TOTAL PAGAMENTO :</strong>'. $linha['Quantidade'] * $linha['Preco']. 'MT';
                $_SESSION['datacompra'] = $linha['Data'];
                $_SESSION['tabela'] = 'Produtos';
            }

            foreach($this->getConexao()->query("SELECT Bebidas.Produto, Bebidas.Descricao, Bebidas.Preco, Compra.Nome, Compra.Contacto, Compra.Pagamento, Compra.NRConta, Compra.Email, Compra.Endereco, Compra.Quantidade, Compra.Data,  Compra.Bebidas_FK FROM Compra JOIN Bebidas WHERE Bebidas.Bebidas_ID = Compra.Bebidas_FK AND Compra.Data LIKE  ('%".$this->getDatacompra()."%')") as $line){
                $_SESSION['infos'] =  
                        'Cliente: '.$line['Nome'].'<br>'. 
                        'Contacto (+258) : '.$line['Contacto'].'<br>'. 
                        'Pagamento :' .$line['Pagamento'].'<br>'. 
                        'NRConta : ' .$line['NRConta'].'<br>'.
                        'Email :' .$line['Email'].'<br>'. 
                        'Endereco :' .$line['Endereco']. '<br>';
                       
                $_SESSION['produtos'] = 
                        'Produto :' .$line['Produto']. '<br>'.
                        'Descricao :' .$line['Descricao']. '<br>'.
                        'Quantidade :' .$line['Quantidade']. " ".'Units<br>'.
                        'Preco : '.$line['Preco']. 'MT<br>'.
                        'Data de requisicao : '.$this->getDatacompra().'<br>'.
                        '<strong>TOTAL PAGAMENTO :</strong>'. $line['Quantidade'] * $line['Preco']. 'MT';
                $_SESSION['datacompra'] = $line['Data'];
                $_SESSION['tabela'] = 'Bebidas';

            }

            foreach($this->getConexao()->query("SELECT Carnes.Produto, Carnes.Descricao, Carnes.Preco, Compra.Nome, Compra.Contacto, Compra.Pagamento, Compra.NRConta, Compra.Email, Compra.Endereco, Compra.Quantidade, Compra.Data,  Compra.Carnes_FK FROM Compra JOIN Carnes WHERE Carnes.Carnes_ID = Compra.Carnes_FK AND Compra.Data LIKE  ('%".$this->getDatacompra()."%')") as $lin){
                $_SESSION['infos'] =  
                        'Cliente: '.$lin['Nome'].'<br>'. 
                        'Contacto (+258) : '.$lin['Contacto'].'<br>'. 
                        'Pagamento :' .$lin['Pagamento'].'<br>'. 
                        'NRConta : ' .$lin['NRConta'].'<br>'.
                        'Email :' .$lin['Email'].'<br>'. 
                        'Endereco :' .$lin['Endereco']. '<br>';
                       
                $_SESSION['produtos'] = 
                        'Produto :' .$lin['Produto']. '<br>'.
                        'Descricao :' .$lin['Descricao']. '<br>'.
                        'Quantidade :' .$lin['Quantidade']. " ".'Units<br>'.
                        'Preco : '.$lin['Preco']. 'MT<br>'.
                        'Data de requisicao : '.$this->getDatacompra().'<br>'.
                        '<strong>TOTAL PAGAMENTO :</strong>'. $lin['Quantidade'] * $lin['Preco']. 'MT';
                $_SESSION['datacompra'] = $lin['Data'];
                $_SESSION['tabela'] = 'Carnes';

            }

            foreach($this->getConexao()->query("SELECT Frutas.Produto, Frutas.Descricao, Frutas.Preco, Compra.Nome, Compra.Contacto, Compra.Pagamento, Compra.NRConta, Compra.Email, Compra.Endereco, Compra.Quantidade, Compra.Data,  Compra.Frutas_FK FROM Compra JOIN Frutas WHERE Frutas.Frutas_ID = Compra.Frutas_FK AND Compra.Data LIKE  ('%".$this->getDatacompra()."%')") as $lne){
                $_SESSION['infos'] =  
                        'Cliente: '.$lne['Nome'].'<br>'. 
                        'Contacto (+258) : '.$lne['Contacto'].'<br>'. 
                        'Pagamento :' .$lne['Pagamento'].'<br>'. 
                        'NRConta : ' .$lne['NRConta'].'<br>'.
                        'Email :' .$lne['Email'].'<br>'. 
                        'Endereco :' .$lne['Endereco']. '<br>';
                       
                $_SESSION['produtos'] = 
                        'Produto :' .$lne['Produto']. '<br>'.
                        'Descricao :' .$lne['Descricao']. '<br>'.
                        'Quantidade :' .$lne['Quantidade']. " ".'Units<br>'.
                        'Preco : '.$lne['Preco']. 'MT<br>'.
                        'Data de requisicao : '.$this->getDatacompra().'<br>'.
                        '<strong>TOTAL PAGAMENTO :</strong>'. $lne['Quantidade'] * $lne['Preco']. 'MT';
                $_SESSION['datacompra'] = $lne['Data'];
                $_SESSION['tabela'] = 'Frutas';

            }
            header("Location:/RegistoCompras.php");
              
        }

        function registoCarrinho() {
            // REGISTO DE PRODUTOS DA COMPRA PELO CARRINHO
            $results = array();
            $dados = array();
    
            $sqlC = $this->getConexao()->query("SELECT Chave FROM Carrinho WHERE Data LIKE ('%".$this->getDatacompra()."%')");
            $sqlC->execute();
            $rs = $sqlC->fetch(PDO::FETCH_ASSOC);
            $sql = $this->getConexao()->query("SELECT * FROM Carrinho WHERE Chave = $rs[Chave]");
            $dds = $this->getConexao()->query("SELECT * FROM Carrinho WHERE Chave = $rs[Chave] LIMIT 1");
            
            foreach($sql as $produto) {
            $results[] = array(
                'Produto' => $produto['Produtos'],
                'Descricao' => $produto['Descricao'],
                'Preco' => $produto['Preco'],
                'Quantidade' => $produto['Quantidade'],
                'Contacto' => $produto['Contacto'],
                'Nome' => $produto['Nome'],
                'Pagamento' => $produto['Pagamento'],
                'Subtotal' => $produto['Subtotal'],
                'Total' => $produto['Total'],
                'NRConta' => $produto['NRConta'],
                'Email' => $produto['Email'],
                'Endereco' => $produto['Endereco'],
                'Chave' => $produto['Chave'],

            );
        }
        
        foreach($dds as $info) {
            $dados[] = array(
                'Contacto' => $info['Contacto'],
                'Chave' => $info['Chave'],
                'Nome' => $info['Nome'],
                'Pagamento' => $info['Pagamento'],
                'NRConta' => $info['NRConta'],
                'Email' => $info['Email'],
                'Endereco' => $info['Endereco'],
                'Data' => $info['Data'],
            );
        }
    
    
        $_SESSION['registo_carrinho'] = $results;
        $_SESSION['dados'] = $dados;
        header("Location:../RegistoCarrinho.php");
    }



        function actualizarProduto(){
            //ACTUALIZAR PROUTO
                try {
                    //  TABELA [Produtos]
                    $sql = $this->getConexao()->prepare("UPDATE Produtos SET Preco = ? WHERE Codigo = ?");
                    $sql->bindValue(1, $this->getNovopreco());
                    $sql->bindValue(2, $this->getCodigo());
                    $sql->execute();
            
                    $_SESSION['actualizar'] = "<p class = 'sucesso'>Actualizou Produto</p>";
                    $this->setResfinal("Produto Actualizado");
                    $this->guardarHistorico();
                
                } catch (Exception $e) {
                    $_SESSION['actualizar'] = "<p class = 'erro'>Erro ao actualizar produto.</p>" . $e->getMessage();
                }
                
                try {
                    //  TABELA [Frutas]
                    $sql = $this->getConexao()->prepare("UPDATE Frutas SET Preco = ? WHERE Codigo = ?");
                    $sql->bindValue(1, $this->getNovopreco());
                    $sql->bindValue(2, $this->getCodigo());
                    $sql->execute();
                 
                     $_SESSION['actualizar'] = "<p class = 'sucesso'>Actualizou Produto</p>";
                     $this->setResfinal("Produto Actualizado");
                     $this->guardarHistorico();
                 
                 } catch (Exception $e) {
                    $_SESSION['actualizar'] = "<p class = 'erro'>Erro ao actualizar produto.</p>". $e->getMessage();
                 }
                
                 try {
                    //  TABELA [Carnes]
                    $sql = $this->getConexao()->prepare("UPDATE Carnes SET Preco = ? WHERE Codigo = ?");
                    $sql->bindValue(1, $this->getNovopreco());
                    $sql->bindValue(2, $this->getCodigo());
                    $sql->execute();
                 
                     $_SESSION['actualizar'] = "<p class = 'sucesso'>Actualizou Produto</p>";
                     $this->setResfinal("Produto Actualizado");
                     $this->guardarHistorico();
                 
                 } catch (Exception $e) {
                    $_SESSION['actualizar'] = "<p class = 'erro'>Erro ao actualizar produto.</p>". $e->getMessage();
                 }
                
                 try {
                    //  TABELA [Bebidas]
                    $sql = $this->getConexao()->prepare("UPDATE Bebidas SET Preco = ? WHERE Codigo = ?");
                    $sql->bindValue(1, $this->getNovopreco());
                    $sql->bindValue(2, $this->getCodigo());
                    $sql->execute();
                 
                     $_SESSION['actualizar'] = "<p class = 'sucesso'>Actualizou Produto</p>";
                    $this->setResfinal("Produto Actualizado");
                    $this->guardarHistorico();
                 
                 } catch (Exception $e) {
                     $_SESSION['actualizar'] = "<p class = 'erro'>Erro ao actualizar produto.</p>". $e->getMessage();
                 }

                 header("Location:../GerenciarProdutos.php");    
        }

        function apagarProduto(){
            // APAGAR PRODUTO
            try {
                foreach($this->getConexao()->query("SELECT * FROM Produtos WHERE Codigo = ". $this->getCodigo()) as $n){
                    $sql = $this->getConexao()->prepare("DELETE FROM Produtos WHERE Codigo = ". $this->getCodigo());
                    $sql->execute();
                    //APAGAR IMAGEM DO PRODUTO
                    $pasta = "../img";
                    if(is_dir($pasta)){
                        $caminho = "$pasta/" . $n['Imagem'];
                        unlink($caminho);
                    }
                    $this->setResfinal("Produto " . $n['Produto']. " Apagado!");
                    $this->guardarHistorico();
                    $_SESSION['apagar'] = "<p class = 'sucesso'>Produto Apagado Com Sucesso!</p>";
                }

                foreach($this->getConexao()->query("SELECT * FROM Frutas WHERE Codigo = ". $this->getCodigo()) as $n){
                    $sql = $this->getConexao()->prepare("DELETE FROM Frutas WHERE Codigo = ". $this->getCodigo());
                    $sql->execute();
                    //APAGAR IMAGEM DO PRODUTO
                    $pasta = "../img";
                    if(is_dir($pasta)){
                        $caminho = "$pasta/" . $n['Imagem'];
                        unlink($caminho);
                    }
                    $this->setResfinal("Produto " . $n['Produto']. " Apagado!");
                    $this->guardarHistorico();
                    $_SESSION['apagar'] = "<p class = 'sucesso'>Produto Apagado Com Sucesso!</p>";
                }
    
                foreach($this->getConexao()->query("SELECT * FROM Bebidas WHERE Codigo = ". $this->getCodigo()) as $n){
                    $sql = $this->getConexao()->prepare("DELETE FROM Bebidas WHERE Codigo = ". $this->getCodigo());
                    $sql->execute();
                    //APAGAR IMAGEM DO PRODUTO
                    $pasta = "../img";
                    if(is_dir($pasta)){
                        $caminho = "$pasta/" . $n['Imagem'];
                        unlink($caminho);
                    }
                    $this->setResfinal("Produto " . $n['Produto']. " Apagado!");
                    $this->guardarHistorico();
                    $_SESSION['apagar'] = "<p class = 'sucesso'>Produto Apagado Com Sucesso!</p>";
                }
    
                foreach($this->getConexao()->query("SELECT * FROM Carnes WHERE Codigo = ". $this->getCodigo()) as $n){
                    $sql = $this->getConexao()->prepare("DELETE FROM Carnes WHERE Codigo = ". $this->getCodigo());
                    $sql->execute();
                    //APAGAR IMAGEM DO PRODUTO
                    $pasta = "../img";
                    if(is_dir($pasta)){
                        $caminho = "$pasta/" . $n['Imagem'];
                        unlink($caminho);
                    }
                    $this->setResfinal("Produto " . $n['Produto']. " Apagado!");
                    $this->guardarHistorico();
                    $_SESSION['apagar'] = "<p class = 'sucesso'>Produto Apagado Com Sucesso!</p>";
                }
               
            } catch (\Throwable $th) {
                $_SESSION['apagar'] = "<p class = 'erro'>Erro ao apagar produto!</p>";
            }
                header("Location:/GerenciarProdutos.php");
            }

       
            function verContacto($numero){
                //VERIFICAR O PREFIXO E TAMANHO DO CONTACTO
                $telefone = strval($numero);

                if(strlen($telefone) != 9){
                    return false;
                } else if(!is_numeric($telefone)){
                    return false;
                } else{
                    if(substr($telefone, 0, 2) === "82" ||
                    substr($telefone, 0, 2) === "83" ||
                    substr($telefone, 0, 2) === "84" ||
                    substr($telefone, 0, 2) === "85" ||
                    substr($telefone, 0, 2) === "86" ||
                    substr($telefone, 0, 2) === "87"){
                        return true;
                    } else{
                        return false;
                    }
                }
            }
            
            function verNome($nome){
                //VERIFICAR O NOME
                $name = str_replace(" ", "", $nome);
                if(!ctype_alpha($name)){
                    return false;
                }elseif(strlen($name) <= 1){
                    return false;
                } else{
                    return true;
                }
            }

            function verConta($numero){
                //VERIFICAR O TAMANHO DO NUMERO DA CONTA
                $conta = strval($numero);

                if(strlen($conta) != 16){
                    return false;
                } elseif(!is_numeric($conta)){
                    return false;
                } elseif(substr($conta, 0, 1) === "4"){
                    return true;
                }
            }

            function verPagamento($pagamento, $num){
                // VERIFICAR O CONTACTO COM O TIPO DE PAGAMENTO
                $numero = strval($num);
            
                if(substr($numero, 0, 2) === "84" && $pagamento == "M-Pesa"){
                    return true;
                } else if(substr($numero, 0, 2) === "85" && $pagamento == "M-Pesa"){
                    return true;
                } else if(substr($numero, 0, 2) === "86" && $pagamento == "E-Mola"){
                    return true;
                } else if(substr($numero, 0, 2) === "87" && $pagamento == "E-Mola"){
                    return true;
                } else{
                    return false;
                }
                
             }

            function guardarHistorico(){
                //GUARDAR HISTORICO DE USUARIO
                $sql = $this->getConexao()->prepare("INSERT INTO Relatorio (Admin_FK, Historico) VALUES (?,?)");
                $sql->bindValue(1, $this->getId_pk());
                $sql->bindValue(2, $this->getResfinal());
                $sql->execute();
            }

}
?>