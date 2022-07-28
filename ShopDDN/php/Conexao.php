<?php
    try{
        $conexao = new PDO("mysql:host=localhost;dbname=ShopDDN", "DNhanombe", "nhanombeddn");
    }catch(PDOException $e){
        echo "Erro de Conexao";
    } catch(Exception $e){
        echo "Falha na Conexao";
    }
?>